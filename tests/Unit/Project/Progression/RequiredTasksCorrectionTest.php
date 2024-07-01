<?php

use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\Task;
use App\Modules\AutomaticGrading\AutomaticGrading;
use App\Modules\AutomaticGrading\AutomaticGradingSettings;
use App\Modules\AutomaticGrading\AutomaticGradingType;
use App\ProjectStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    /** @var Task $task */
    $task = Task::factory([
        'sub_tasks'       => [
            new SubTask('test 11 Equals [10, 1]', 'test 11 equals [10, 1]'),
            new SubTask('test 9 Equals [5,2,2]', 'test 9 equals [5,2,2]'),
            new SubTask('install', 'install'),
        ],
    ])->for(Course::factory())->make();
    $task->starts_at = '2022-01-28 00:00:00'; // We assign this a date before the created_at date in the pipeline file.

    $task->module_configuration->addModule(AutomaticGrading::class);
    $settings = new AutomaticGradingSettings();
    $settings->gradingType = AutomaticGradingType::REQUIRED_SUBTASKS->value;
    $settings->requiredSubtaskIds = [1, 3];
    $task->module_configuration->update(AutomaticGrading::class, $settings);
    $task->save();

    $this->project = Project::factory()->for($task)->createQuietly();
});

it('ensures projects to be active when no subtasks are complete', function () {
    expect($this->project->status)->toEqual(ProjectStatus::Active);
});


it('ensures projects to be active when 1 of 2 required subtask are complete', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 1,
    ]);
    expect($this->project->status)->toEqual(ProjectStatus::Active);
});

it('ensures projects to be active when 1 required subtask is complete and 1 optional is complete', function () {
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
    expect($this->project->status)->toEqual(ProjectStatus::Active);
});

it('ensures projects to be active when 2 of 2 required subtask are complete', function () {
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
    expect($this->project->status)->toEqual(ProjectStatus::Finished);
});

it('ensures projects to be finished when 2 of 2 required subtask are complete and 1 optional is complete', function () {
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
    expect($this->project->status)->toEqual(ProjectStatus::Finished);
});
