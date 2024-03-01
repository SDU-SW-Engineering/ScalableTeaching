<?php

use App\Models\Course;
use App\Models\Enums\GradeEnum;
use App\Models\Grade;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Modules\MarkAsDone\MarkAsDone;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

/**
 * This file tests the MarkAsDone module, that can be installed on a task, and it's related features.
 */

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->course = Course::factory()->create();
    /**
     * @var Task $task
     */
    $task = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at'   => Carbon::create(2022, 8, 24, 23, 59, 59),
    ])->for($this->course)->create();
    $task->module_configuration->addModule(MarkAsDone::class);
    $task->save();
    $this->task = $task;
    $this->user = User::factory()->hasAttached($this->course)->create();
    Carbon::setTestNow(Carbon::create(2022, 8, 16));
    actingAs($this->user);
    $this->projectByUser = Project::factory([
        "task_id" => $task,
    ])->for($this->user, 'ownable')->create();

});

it('allows students to mark their solo projects as complete', function() {
    post(route('courses.tasks.mark-complete', [$this->course->id, $this->task->id, $this->projectByUser->id]))->assertStatus(200);

    assertDatabaseHas('grades', [
        'user_id' => $this->user->id,
        'task_id' => $this->task->id,
        'value'   => 'passed',
    ]);
});

it('allows students to mark their group projects as complete', function() {
    $group = Group::factory()->for($this->course)->hasAttached($this->user, ['is_owner' => false], "members")->create();
    $projectByGroup = Project::factory([
        "task_id" => $this->task->id,
    ])->for($group, 'ownable')->create();
    post(route('courses.tasks.mark-complete', [$this->course->id, $this->task->id, $projectByGroup->id]))->assertStatus(200);

    assertDatabaseHas('grades', [
        'user_id' => $this->user->id,
        'task_id' => $this->task->id,
        'value'   => 'passed',
    ]);
});

it('prevents students from marking their projects as complete more than once', function() {
    Grade::create([
        'user_id'     => $this->user->id,
        'task_id'     => $this->task->id,
        'value'       => GradeEnum::Passed,
        'source_id'   => $this->projectByUser->id,
        'source_type' => Project::class,
    ]);

    post(route('courses.tasks.mark-complete', [$this->course->id, $this->task->id, $this->projectByUser->id]))->assertStatus(400);
    assertDatabaseCount('grades', 1);
});

it('prevents students from marking projects as complete if module is not installed', function() {
    $task = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at'   => Carbon::create(2022, 8, 24, 23, 59, 59),
    ])->for($this->course)->create();

    $project = Project::factory([
        "task_id" => $task,
    ])->for($this->user, 'ownable')->create();

    post(route('courses.tasks.mark-complete', [$this->course->id, $task->id, $project->id]))->assertStatus(400);
});

it('prevents students from marking a project complete that is not theirs', function() {
   $user = User::factory()->hasAttached($this->course)->create();
   actingAs($user);

    post(route('courses.tasks.mark-complete', [$this->course->id, $this->task->id, $this->projectByUser->id]))->assertStatus(403);
});

