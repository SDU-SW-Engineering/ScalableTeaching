<?php

use App\Models\Course;
use App\Models\Enums\TaskDelegationType;
use App\Models\Project;
use App\Models\ProjectFeedback;
use App\Models\ProjectPush;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertEmpty;

uses(RefreshDatabase::class);

beforeEach(function () {
    Queue::fake();

    $this->task = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at'   => Carbon::create(2022, 8, 24, 23, 59),
    ])->for(Course::factory())->create();
    createProjects($this);
});

it('does not delegate projects that are before the deadline of the task', function () {
    createDelegation($this);
    Carbon::setTestNow(Carbon::create(2022, 8, 12, 12));
    assertDatabaseCount('project_feedback', 0);
    Artisan::call('tasks:delegate');
    assertDatabaseCount('project_feedback', 0);
    assertDatabaseHas('task_delegations', [
        'delegated' => false,
        'task_id'   => $this->task->id,
    ]);
});

it('delegates finished projects after the deadline of the task', function () {
    createDelegation($this);
    assertDatabaseCount('project_feedback', 0);
    Artisan::call('tasks:delegate');
    assertDatabaseCount('project_feedback', 8);
    assertDatabaseHas('task_delegations', [
        'delegated' => true,
        'task_id'   => $this->task->id,
    ]);
});

it('does not delegate projects with no commits', function () {
    createProjects($this, 2, false);
    createDelegation($this);
    assertDatabaseCount('project_feedback', 0);
    Artisan::call('tasks:delegate');
    assertDatabaseCount('project_feedback', 8);
    assertDatabaseHas('task_delegations', [
        'delegated' => true,
        'task_id'   => $this->task->id,
    ]);
});

it('delegates projects to teachers equally', function () {
    addTeachers($this);
    createDelegation($this, 1, 2);
    assertDatabaseCount('project_feedback', 0);
    Artisan::call('tasks:delegate');
    assertDatabaseCount('project_feedback', 4);
    assertDatabaseHas('task_delegations', [
        'delegated' => true,
        'task_id'   => $this->task->id,
    ]);
});

it('delegates all projects to all teachers', function () {
    addTeachers($this);
    createDelegation($this, 0, 2);
    assertDatabaseCount('project_feedback', 0);
    Artisan::call('tasks:delegate');
    assertDatabaseCount('project_feedback', 8);
    assertDatabaseHas('task_delegations', [
        'delegated' => true,
        'task_id'   => $this->task->id,
    ]);
});

it('does not delegate to excluded teachers', function () {
    addTeachers($this, 4);
    $excusedTeachers = $this->task->course->teachers()->take(2)->get();
    createDelegation($this, 0, 2, $excusedTeachers);
    assertDatabaseCount('project_feedback', 0);
    Artisan::call('tasks:delegate');
    assertDatabaseCount('project_feedback', 8);
    assertDatabaseHas('task_delegations', [
        'delegated' => true,
        'task_id'   => $this->task->id,
    ]);
    assertEmpty(ProjectFeedback::wherein("task_delegation_id", $this->task->delegations()->pluck("id")->toArray())->whereIn("user_id", $excusedTeachers->pluck("id")->toArray())->get());
});

it('does not delegate to excluded students', function () {
    $excusedStudents = $this->task->course->students()->take(1)->get();
    createDelegation($this, 2, 1, $excusedStudents);
    assertDatabaseCount('project_feedback', 0);
    Artisan::call('tasks:delegate');
    assertDatabaseCount('project_feedback', 6);
    assertDatabaseHas('task_delegations', [
        'delegated' => true,
        'task_id'   => $this->task->id,
    ]);
    assertEmpty(ProjectFeedback::wherein("task_delegation_id", $this->task->delegations()->pluck("id")->toArray())->whereIn("user_id", $excusedStudents->pluck("id")->toArray())->get());
});

/**
 * @param TestCase $testCase
 * @param int $nop Number of projects to be generated
 * @param bool $has_handed_in If the projects have been handed in
 * @return void
 */
function createProjects(TestCase $testCase, int $nop = 4, bool $has_handed_in = true): void
{
    User::factory($nop)->hasAttached($testCase->task->course)->create()->each(function (User $user) use ($has_handed_in, $testCase) {
        $project = Project::factory()
            ->set("final_commit_sha", $has_handed_in ? fake()->sha256() : null)
            ->set("status", $has_handed_in ? "finished" : "overdue")
            ->for($testCase->task)
            ->for($user, 'ownable')
            ->has(ProjectPush::factory()->before($testCase->task->ends_at), 'pushes')->createQuietly();
    });
}

/**
 * @param TestCase $testCase
 * @param int $nop Number of projects to be generated
 * @param int $role The role of the reviewers (1 = Students, 2 = teachers)
 * @param array|Collection $users Users to add to the user pool
 * @return void
 */
function createDelegation(TestCase $testCase, int $nop = 2, int $role = 1, array|Collection $users = []): void
{
    $delegation = $testCase->task->delegations()->create([
        'number_of_projects' => $nop,
        'type'               => TaskDelegationType::LastPushes,
        'course_role_id'     => $role,
        'feedback'           => 1,
        'grading'            => 0,
        'deadline_at'        => $testCase->task->ends_at->copy()->addDays(2),
    ]);

    if ( ! empty($users))
    {
        $delegation->userPool()->attach($users);
    }
}

/**
 * @param TestCase $testCase
 * @param int $numberOfTeachers Number of teachers to be generated
 * @return void
 */
function addTeachers(TestCase $testCase, int $numberOfTeachers = 2): void
{
    User::factory($numberOfTeachers)->hasAttached($testCase->task->course, ["role" => "teacher"])->create();
}
