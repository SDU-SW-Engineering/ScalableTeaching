<?php

use App\Models\Course;
use App\Models\Enums\TaskDelegationType;
use App\Models\Project;
use App\Models\ProjectPush;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->course = Course::factory()->create();
    $this->taskEndsAt = Carbon::create(2022, 8, 24, 23, 59);
    $this->task = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at'   => $this->taskEndsAt,
    ])->for($this->course)->create();
    $this->user = User::factory()->hasAttached($this->course, ['role' => 'teacher'])->create();
    $this->students = User::factory(4)->hasAttached($this->course)->create()->each(function(User $user) {
        $project = Project::factory()->for($this->task)->for($user, 'ownable')->createQuietly();
        ProjectPush::factory(3)->for($project)->create([
            'created_at' => $this->taskEndsAt->copy()->subHours(2) // push needs to be before the deadline of task
        ]);
    });
    actingAs($this->user);
});

it('delegates tasks with type of last pushes', function() {
    $taskDelegation = $this->task->delegations()->create([
        'number_of_tasks' => 2,
        'type'            => TaskDelegationType::LastPushes,
        'course_role_id'  => 1, // students (for now),
        'feedback'        => 1,
        'grading'         => 0,
        'deadline_at'     => $this->taskEndsAt->addDays(2)
    ]);

    $taskDelegation->delegate();

    assertDatabaseCount('project_feedback', 8);
    dd(\App\Models\ProjectFeedback::all()->toArray());
});

it('fails to delegate if task has not ended yet');
