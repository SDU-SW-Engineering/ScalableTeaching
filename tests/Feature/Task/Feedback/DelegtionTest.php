<?php

use App\Models\Course;
use App\Models\Enums\TaskDelegationType;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->course = Course::factory()->create();
    $this->taskEndsAt = Carbon::create(2022, 8, 24, 23, 59);
    $this->task = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at'   => $this->taskEndsAt,
    ])->for($this->course)->create();
    Project::factory(3)->for($this->task)->create();
    $this->user = User::factory()->hasAttached($this->course, ['role' => 'teacher'])->create();
    actingAs($this->user);
});

it('creates a task delegation', function() {
    post(route('courses.tasks.admin.subtaskGradingAndFeedback.delegation.store', [$this->course, $this->task]), [
        'tasks'         => 1,
        'options'       => [
            'feedback'   => 'on',
            'moderation' => 'on',
        ],
        'deadline_date' => $this->taskEndsAt->copy()->addDays(2)->format('Y-m-d'),
        'deadline_hour' => "23:59",
        'type'          => 'last_pushes',
        'role'          => 'student',
        'pool'          => 'role',
    ])->assertStatus(302)->assertValid();

    assertDatabaseCount('task_delegations', 1);
    assertDatabaseHas('task_delegations', [
        'number_of_projects' => 1,
        'feedback'           => true,
        'type'               => TaskDelegationType::LastPushes,
        'deadline_at'        => $this->taskEndsAt->copy()->addDays(2)->toDateTimeString(),
    ]);
});

it('does not allow delegating more projects than available', function() {
    post(route('courses.tasks.admin.subtaskGradingAndFeedback.delegation.store', [$this->course, $this->task]), [
        'tasks'         => 5,
        'options'       => [
            'feedback'   => 'on',
            'moderation' => 'on',
        ],
        'deadline_date' => $this->taskEndsAt->copy()->addDays(2)->format('Y-m-d'),
        'deadline_hour' => "23:59",
        'type'          => 'last_pushes',
        'role'          => 'student',
        'pool'          => 'role',
    ])->assertInvalid('tasks');
});
