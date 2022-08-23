<?php

use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\Task;
use App\ProjectStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->project = Project::factory()->for(Task::factory([
        'correction_type'            => CorrectionType::PointsRequired,
        'correction_points_required' => 75,
        'sub_tasks'                  => [
            (new SubTask('11 Equals [10, 1]', 'test 11 equals [10, 1]'))->setPoints(50),
            (new SubTask('9 Equals [5,2,2]', 'test 9 equals [5,2,2]'))->setPoints(25),
            (new SubTask('2 Equals [2]', 'test 2 equals [2]'))->setPoints(40),
        ],
    ])->for(Course::factory()))->createQuietly();
});

it('ensures projects are active when 0 subtasks have been completed', function () {
    expect($this->project->status)->toBe(ProjectStatus::Active);
});

it('ensures projects are active when 50 of 75 points have been reached', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 1,
    ]);
    $this->project->refresh();

    expect($this->project->status)->toBe(ProjectStatus::Active);
});

it('ensures projects are active when 25 of 75 points have been reached', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 2,
    ]);
    $this->project->refresh();

    expect($this->project->status)->toBe(ProjectStatus::Active);
});

it('ensures projects are finished when 75 of 75 points have been reached', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 1,
    ]);
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 2,
    ]);
    $this->project->refresh();

    expect($this->project->status)->toBe(ProjectStatus::Finished);
});

it('ensures projects are finished when 115 of 75 points have been reached', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 1,
    ]);
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 2,
    ]);
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 3,
    ]);
    $this->project->refresh();

    expect($this->project->status)->toBe(ProjectStatus::Finished);
});

it('ensures projects are active when 65 of 75 points have been reached', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 2,
    ]);
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 3,
    ]);
    $this->project->refresh();

    expect($this->project->status)->toBe(ProjectStatus::Active);
});
