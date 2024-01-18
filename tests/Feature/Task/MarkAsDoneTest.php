<?php

use App\Models\Course;
use App\Models\Enums\GradeEnum;
use App\Models\Grade;
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

});

it('allows students to mark their assignments as complete', function() {
    post(route('courses.tasks.mark-complete', [$this->course->id, $this->task->id]))->assertStatus(200);

    assertDatabaseHas('grades', [
        'user_id' => $this->user->id,
        'task_id' => $this->task->id,
        'value'   => 'passed',
    ]);
});

it('prevents students from marking their assignments as complete more than once', function() {
    Grade::create([
        'user_id'     => $this->user->id,
        'task_id'     => $this->task->id,
        'value'       => GradeEnum::Passed,
        'source_id'   => $this->user->id,
        'source_type' => User::class,
    ]);

    post(route('courses.tasks.mark-complete', [$this->course->id, $this->task->id]))->assertStatus(400);
    assertDatabaseCount('grades', 1);
});

it('prevents students from marking assignments as complete if module is not installed', function() {
    $task = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at'   => Carbon::create(2022, 8, 24, 23, 59, 59),
    ])->for($this->course)->create();

    post(route('courses.tasks.mark-complete', [$this->course->id, $task->id]))->assertStatus(400);
});


