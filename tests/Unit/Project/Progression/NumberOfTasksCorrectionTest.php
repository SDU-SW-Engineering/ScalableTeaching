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

beforeEach(function ()
{
    $this->project = Project::factory()->for(Task::factory([
        'correction_type'  => CorrectionType::NumberOfTasks,
        'correction_tasks_required' => 2,
        'sub_tasks'        => [
            (new SubTask('11 Equals [10, 1]', 'test 11 equals [10, 1]'))->setIsRequired(true),
            new SubTask('9 Equals [5,2,2]', 'test 9 equals [5,2,2]'),
            (new SubTask('2 Equals [2]', 'test 2 equals [2]'))->setIsRequired(true)
        ]
    ])->for(Course::factory()))->createQuietly();
});

it('ensures projects to be active when no subtasks are complete', function ()
{
    expect($this->project->status)->toBe(ProjectStatus::Active);
});


it('ensures projects to be active when 1 of 3 subtasks are complete', function ()
{
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id' => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 1
    ]);
    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Active);
});

it('ensures projects to be finished when 2 of 3 subtasks are  complete', function ()
{
    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id' => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 1
        ],
        [
            'source_type' => Pipeline::class,
            'source_id' => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 2
        ]
    ]);
    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Finished);
});


it('ensures projects to be finished when 3 of 3 subtasks are complete', function ()
{
    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id' => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 1
        ],
        [
            'source_type' => Pipeline::class,
            'source_id' => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 2
        ],
        [
            'source_type' => Pipeline::class,
            'source_id' => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 3
        ]
    ]);
    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Finished);
});
