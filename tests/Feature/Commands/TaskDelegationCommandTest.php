<?php

use App\Models\Course;
use App\Models\Enums\TaskDelegationType;
use App\Models\Project;
use App\Models\ProjectPush;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

beforeEach(function() {
    Queue::fake();

    $this->task = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at'   => Carbon::create(2022, 8, 24, 23, 59),
    ])->for(Course::factory())->create();
    User::factory(4)->hasAttached($this->task->course)->create()->each(function(User $user) {
        $project = Project::factory()->for($this->task)->for($user, 'ownable')->has(ProjectPush::factory()->before($this->task->ends_at), 'pushes')->createQuietly();
    });
    $this->task->delegations()->create([
        'number_of_projects' => 2,
        'type'               => TaskDelegationType::LastPushes,
        'course_role_id'     => 1, // students (for now),
        'feedback'           => 1,
        'grading'            => 0,
        'deadline_at'        => $this->task->ends_at->copy()->addDays(2),
    ]);
});

it('does not delegate tasks that are before the deadline of the task', function() {
    Carbon::setTestNow(Carbon::create(2022, 8, 12, 12));
    assertDatabaseCount('project_feedback', 0);
    Artisan::call('tasks:delegate');
    assertDatabaseCount('project_feedback', 0);
    assertDatabaseHas('task_delegations', [
        'delegated' => false,
        'task_id'   => $this->task->id,
    ]);
});

it('delegates tasks after the deadline of the task', function() {
    assertDatabaseCount('project_feedback', 0);
    Artisan::call('tasks:delegate');
    assertDatabaseCount('project_feedback', 8);
    assertDatabaseHas('task_delegations', [
        'delegated' => true,
        'task_id'   => $this->task->id,
    ]);
});
