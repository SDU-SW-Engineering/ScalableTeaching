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

it('returns 0 when 0 of 3 subtasks are complete', function () {
    expect($this->project->progress())->toBe(0);
});


it('returns 43 when subtask 1 is complete', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
        'sub_task_id' => 1,
    ]);
    $this->project->refresh();
    expect($this->project->progress())->toBe(43);
})->skip('Skipped until AutomaticGradingType::POINTS_REQUIRED is implemented');

it('returns 65 when subtask 1 and 2 are complete', function () {
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
    expect($this->project->progress())->toBe(65);
})->skip('Skipped until AutomaticGradingType::POINTS_REQUIRED is implemented');

it('returns 100 when subtask 1, 2 and 3 are complete', function () {
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

it('returns 78 when subtask 1 and 3 are complete', function () {
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
    expect($this->project->progress())->toBe(78);
})->skip('Skipped until AutomaticGradingType::POINTS_REQUIRED is implemented');

it('returns 57 when subtask 2 and 3 are complete', function () {
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
    expect($this->project->progress())->toBe(57);
})->skip('Skipped until AutomaticGradingType::POINTS_REQUIRED is implemented');
