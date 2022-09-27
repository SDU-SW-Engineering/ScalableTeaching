<?php

use App\Exceptions\TaskDelegationException;
use App\Jobs\Project\DownloadProject;
use App\Jobs\Project\IndexRepositoryChanges;
use App\Models\Course;
use App\Models\Enums\TaskDelegationType;
use App\Models\Group;
use App\Models\Project;
use App\Models\ProjectDownload;
use App\Models\ProjectPush;
use App\Models\Task;
use App\Models\TaskDelegation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

uses(RefreshDatabase::class);

beforeEach(function() {
    Queue::fake([DownloadProject::class, IndexRepositoryChanges::class]);
    $this->latestPushes = new Collection();
    $this->course = Course::factory()->create();
    $this->taskEndsAt = Carbon::create(2022, 8, 24, 23, 59);
    $this->task = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at'   => $this->taskEndsAt,
    ])->for($this->course)->create();
    $this->user = User::factory()->hasAttached($this->course, ['role' => 'teacher'])->create();

    actingAs($this->user);
});

function createStudents(int $count, bool $withPushes = true)
{
    test()->students = User::factory($count)->hasAttached(test()->course)->create()->each(function(User $user) use ($withPushes) {
        $project = Project::factory()->for(test()->task)->for($user, 'ownable')->createQuietly();
        if (!$withPushes)
            return;
        test()->latestPushes[] = ProjectPush::factory()->for($project)->create([
            'created_at' => test()->taskEndsAt->copy()->subHours(2), // push needs to be before the deadline of task
        ]);
        ProjectPush::factory()->for($project)->create([
            'created_at' => test()->taskEndsAt->copy()->subHours(4), // push needs to be before the deadline of task
        ]);
        ProjectPush::factory()->for($project)->create([
            'created_at' => test()->taskEndsAt->copy()->addHours(4), // tests that later pushes are not included
        ]);
    });
}

function createGroup()
{
    $group = Group::factory()->for(test()->course)->create();
    $project = Project::factory()->for(test()->task)->for($group, 'ownable')->createQuietly();
    test()->latestPushes[] = ProjectPush::factory()->for($project)->create([
        'created_at' => test()->taskEndsAt->copy()->subHours(2), // push needs to be before the deadline of task
    ]);
    ProjectPush::factory()->for($project)->create([
        'created_at' => test()->taskEndsAt->copy()->subHours(4), // push needs to be before the deadline of task
    ]);

    return $group;
}

function delegateTasks(int $numberOfTasks) : TaskDelegation
{
    $delegation = test()->task->delegations()->create([
        'number_of_tasks' => $numberOfTasks,
        'type'            => TaskDelegationType::LastPushes,
        'course_role_id'  => 1, // students (for now),
        'feedback'        => 1,
        'grading'         => 0,
        'deadline_at'     => test()->taskEndsAt->addDays(2),
    ]);
    $delegation->delegate();

    $delegation->refresh();
    return $delegation;
}

it('delegates tasks with type of last pushes', function() {
    createStudents(4);
    delegateTasks(2);

    assertDatabaseCount('project_feedback', 8);

    $this->students->each(function(User $user) {
        expect($this->latestPushes->pluck('after_sha'))->toContain(...$this->latestPushes->pluck('after_sha'));
    });
});

it('does not delegate tasks to their owner', function() {
    createStudents(4);
    delegateTasks(2);

    $this->students->each(function(User $user) {
        $project = $user->projects()->where('task_id', $this->task->id)->first();
        $userPushSha = $this->latestPushes->where('project_id', $project->id)->first()->after_sha;
        expect($user->feedback()->pluck('sha'))->not()->toContain($userPushSha);
    });
});

it('delegates tasks to group members', function() {
    $group1 = createGroup();
    $group1Users = User::factory(2)->hasAttached($this->course)->hasAttached($group1)->create();
    $group2 = createGroup();
    $group2Users = User::factory(2)->hasAttached($this->course)->hasAttached($group2)->createQuietly();
    delegateTasks(2);

    $group1Users->each(function(User $user) use ($group1) {
        $project = $group1->projects()->first();
        $otherGroupPush = $this->latestPushes->where('project_id', '!=', $project->id)->pluck('after_sha')->first();
        $assignedTasks = $user->feedback()->pluck('sha');
        expect($assignedTasks)->toContain($otherGroupPush);
        $currentGroupPush = $this->latestPushes->where('project_id', $project->id)->pluck('after_sha')->first();
        expect($assignedTasks)->not()->toContain($currentGroupPush);
    });

    $group2Users->each(function(User $user) use ($group2) {
        $project = $group2->projects()->first();
        $otherGroupPush = $this->latestPushes->where('project_id', '!=', $project->id)->pluck('after_sha')->first();
        $assignedTasks = $user->feedback()->pluck('sha');
        expect($assignedTasks)->toContain($otherGroupPush);
        $currentGroupPush = $this->latestPushes->where('project_id', $project->id)->pluck('after_sha')->first();
        expect($assignedTasks)->not()->toContain($currentGroupPush);
    });
});

it('delegates tasks to group members and users', function() {
    $group1 = createGroup();
    $group1Users = User::factory(2)->hasAttached($this->course)->hasAttached($group1)->create();
    createStudents(1);
    delegateTasks(2);

    $group1Users->each(function(User $user) use ($group1) {
        $project = $group1->projects()->first();
        $otherUserPush = $this->latestPushes->where('project_id', '!=', $project->id)->pluck('after_sha')->first();
        $assignedTasks = $user->feedback()->pluck('sha');
        expect($assignedTasks)->toContain($otherUserPush);
        $currentGroupPush = $this->latestPushes->where('project_id', $project->id)->pluck('after_sha')->first();
        expect($assignedTasks)->not()->toContain($currentGroupPush);
    });

    $user = $this->students[0];
    $project = $user->projects()->first();
    $otherGroupPush = $this->latestPushes->where('project_id', '!=', $project->id)->pluck('after_sha')->first();
    $assignedTasks = $user->feedback()->pluck('sha');
    expect($assignedTasks)->toContain($otherGroupPush);
    $currentUserPush = $this->latestPushes->where('project_id', $project->id)->pluck('after_sha')->first();
    expect($assignedTasks)->not()->toContain($currentUserPush);
});

it('wont delegate tasks if there are not enough members to delegate to', function() {
    createStudents(1);
    delegateTasks(2);
})->throws(TaskDelegationException::class, 'Not enough students to delegate.');

it('only delegates the to the max available', function() {
    createStudents(2);
    delegateTasks(2);

    assertDatabaseCount('project_feedback', 2);
});

it('delegates the correct amount if possible', function() {
    createStudents(3);
    delegateTasks(2);

    assertDatabaseCount('project_feedback', 6);
});

it('fails to delegate if task has not ended yet', function() {
    Carbon::setTestNow(Carbon::create(2022, 7, 24, 23, 59));
    createStudents(2);
    delegateTasks(2);
})->throws(TaskDelegationException::class, "Cannot delegate before task has ended.");

it('adds projects to the projects_download table', function() {
    createStudents(3);
    delegateTasks(2);

    assertDatabaseCount('project_downloads', 6);
    expect(ProjectDownload::pluck('ref'))->toEqual($this->task->delegations()->first()->feedback()->get()->pluck('sha'));
});

it('queues delegated tasks for download', function() {
    createStudents(3);
    delegateTasks(2);

    Queue::assertPushedOn('downloads', DownloadProject::class);
    Queue::assertPushed(DownloadProject::class, 6);
});

it('queues indexing of repository changes when tasks are delegated', function() {
    createStudents(3);
    delegateTasks(2);

    Queue::assertPushedOn('index', IndexRepositoryChanges::class);
    Queue::assertPushed(IndexRepositoryChanges::class, 6);;
});

it('marks itself as delegated when done delegating', function() {
    createStudents(3);
    $delegation = delegateTasks(2);
    expect($delegation->delegated)->toBeTrue();
});

it('skips tasks that have zero pushes', function() {
    createStudents(1, false);
    createStudents(2);
    delegateTasks(2);
    assertDatabaseCount('project_feedback', 4);
});
