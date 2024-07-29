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
    $this->subtasks = createSubTasks([
        ['title' => 'test 11 Equals [10, 1]', 'points' => 50],
        ['title' => 'test 9 Equals [5,2,2]', 'points' => 25],
        ['title' => 'install', 'points' => 40],
    ]);

    /** @var Task $task */
    $task = Task::factory([
        'sub_tasks'       => $this->subtasks,
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

it('ensures projects are active when 0 subtasks have been completed', function () {
    expect($this->project->status)->toBe(ProjectStatus::Active);
});

it('ensures projects are active when 50 of 75 points have been reached', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 1,
        'points'      => $this->subtasks[0]->points,
    ]);
    $this->project->refresh();

    expect($this->project->status)->toBe(ProjectStatus::Active);
});

it('ensures projects are active when 25 of 75 points have been reached', function () {
    $this->project->subTasks()->create([
        'source_type'   => Pipeline::class,
        'source_id'     => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id'   => 2,
        'points'        => $this->subtasks[1]->points,
    ]);
    $this->project->refresh();

    expect($this->project->status)->toBe(ProjectStatus::Active);
});

it('ensures projects are finished when 75 of 75 points have been reached', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 1,
        'points'      => $this->subtasks[0]->points,
    ]);
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 2,
        'points'      => $this->subtasks[1]->points,
    ]);
    $this->project->refresh();

    expect($this->project->status)->toEqual(ProjectStatus::Finished);
});

it('ensures projects are finished when 115 of 75 points have been reached', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 1,
        'points'      => $this->subtasks[0]->points,
    ]);
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 2,
        'points'      => $this->subtasks[1]->points,
    ]);
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 3,
        'points'      => $this->subtasks[2]->points,
    ]);
    $this->project->refresh();

    expect($this->project->status)->toEqual(ProjectStatus::Finished);
});

it('ensures projects are active when 65 of 75 points have been reached', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 2,
        'points'      => $this->subtasks[1]->points,
    ]);
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 3,
        'points'      => $this->subtasks[2]->points,
    ]);
    $this->project->refresh();

    expect($this->project->status)->toEqual(ProjectStatus::Active);
});
