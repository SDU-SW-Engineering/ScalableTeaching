<?php

use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\Task;
use App\ProjectStatus;

beforeEach(function ()
{
    $this->project = Project::factory()->for(Task::factory([
        'correction_type' => CorrectionType::RequiredTasks,
        'sub_tasks'       => [
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


it('ensures projects to be active when 1 of 2 required subtask are complete', function ()
{
    $this->project->subTasks()->create([
        'pipeline_id' => Pipeline::factory()->for($this->project)->create()->id,
        'sub_task_id' => 1
    ]);
    expect($this->project->status)->toBe(ProjectStatus::Active);
});

it('ensures projects to be active when 1 required subtask is complete and 1 optional is complete', function ()
{
    $this->project->subTasks()->createMany([
        [
            'pipeline_id' => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 1
        ],
        [
            'pipeline_id' => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 2
        ]
    ]);
    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Active);
});

it('ensures projects to be active when 2 of 2 required subtask are complete', function ()
{
    $this->project->subTasks()->createMany([
        [
            'pipeline_id' => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 1
        ],
        [
            'pipeline_id' => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 3
        ]
    ]);
    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Finished);
});

it('ensures projects to be finished when 2 of 2 required subtask are complete and 1 optional is complete', function ()
{
    $this->project->subTasks()->createMany([
        [
            'pipeline_id' => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 1
        ],
        [
            'pipeline_id' => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 2
        ],
        [
            'pipeline_id' => Pipeline::factory()->for($this->project)->create()->id,
            'sub_task_id' => 3
        ]
    ]);
    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Finished);
});
