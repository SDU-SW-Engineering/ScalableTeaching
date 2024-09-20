<?php

use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\Task;
use App\Modules\AutomaticGrading\AutomaticGrading;
use App\Modules\AutomaticGrading\AutomaticGradingSettings;
use App\Modules\AutomaticGrading\AutomaticGradingType;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->subTask1 = new SubTask('test 11 Equals [10, 1]', 'test 11 equals [10, 1]');
    $this->subTask1->setPoints(50);
    $this->subTask2 = new SubTask('test 9 Equals [5,2,2]', 'test 9 equals [5,2,2]');
    $this->subTask2->setPoints(25);
    $this->subTask3 = new SubTask('install', 'install');
    $this->subTask3->setPoints(40);
    /** @var Task $task */
    $task = Task::factory([
        'sub_tasks'       => [
            $this->subTask1,
            $this->subTask2,
            $this->subTask3,
        ],
    ])->for(Course::factory())->make();
    $task->starts_at = '2022-01-28 00:00:00'; // We assign this a date before the created_at date in the pipeline file.

    $task->module_configuration->addModule(AutomaticGrading::class);
    $settings = new AutomaticGradingSettings();
    $settings->gradingType = AutomaticGradingType::POINTS_REQUIRED->value;
    $settings->pointsRequired = 75;
    $task->module_configuration->update(AutomaticGrading::class, $settings, $task);
    $task->save();

    $this->project = Project::factory()->for($task)->createQuietly();
});

it('returns 0 when 0 of 3 subtasks are complete', function () {
    expect($this->project->progress())->toBe(0);
});


it('returns 67% when subtask 1 is complete', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
        'sub_task_id' => 1,
    ]);
    $this->project->refresh();
    expect($this->project->progress())->toBe(67);
});

it('returns 100% when subtask 1 and 2 are complete', function () {
    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ],
    ]);
    $this->project->refresh();
    expect($this->project->progress())->toBe(100);
});

it('returns 100% when subtask 1, 2 and 3 are complete', function () {
    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ],
    ]);
    $this->project->refresh();
    expect($this->project->progress())->toBe(100);
});

it('returns 100% when subtask 1 and 3 are complete', function () {
    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ],
    ]);
    $this->project->refresh();
    expect($this->project->progress())->toBe(100);
});

it('returns 87% when subtask 2 and 3 are complete', function () {
    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ],
    ]);
    $this->project->refresh();
    expect($this->project->progress())->toBe(87);
});
