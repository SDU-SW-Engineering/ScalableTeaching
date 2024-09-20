<?php

use App\Models\Casts\SubTask;
use App\Models\Course;
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
            (new SubTask('11 Equals [10, 1]', 'test 11 equals [10, 1]'))->setIsRequired(true),
            new SubTask('9 Equals [5,2,2]', 'test 9 equals [5,2,2]'),
            (new SubTask('2 Equals [2]', 'test 2 equals [2]'))->setIsRequired(true),
        ],
    ])->for(Course::factory())->make();

    $task->module_configuration->addModule(AutomaticGrading::class);
    $settings = new AutomaticGradingSettings();
    $settings->gradingType = AutomaticGradingType::PIPELINE_SUCCESS->value;
    $task->module_configuration->update(AutomaticGrading::class, $settings, $task);
    $task->save();

    $this->project = Project::factory()->for($task)->createQuietly();
});

it('ensures projects to be active when no pipelines have been submitted', function () {
    expect($this->project->status)->toBe(ProjectStatus::Active);
});


it('ensures projects to be finished when a successful pipelines have been submitted', function () {
    Pipeline::factory()->succeeding()->for($this->project)->create();
    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Finished);
});

it('ensures projects to be active when a failed pipelines have been submitted', function () {
    Pipeline::factory()->failing()->for($this->project)->create();
    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Active);
});

it('ensures projects to be active when a pending pipelines have been submitted', function () {
    Pipeline::factory()->pending()->for($this->project)->create();
    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Active);
});

it('ensures projects to be active when a running pipelines have been submitted', function () {
    Pipeline::factory()->running()->for($this->project)->create();
    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Active);
});

it('ensures sub tasks do not affect the project when pipeline correction is set', function () {
    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->failing()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->failing()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->failing()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ],
    ]);
    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Active);
});
