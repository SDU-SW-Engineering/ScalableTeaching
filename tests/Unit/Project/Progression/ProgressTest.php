<?php

use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\Task;
use App\Modules\AutomaticGrading\AutomaticGrading;
use App\Modules\AutomaticGrading\AutomaticGradingSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->project = Project::factory()->for(Task::factory([
        'sub_tasks' => [
            new SubTask('11 Equals [10, 1]', 'test 11 equals [10, 1]'),
            new SubTask('9 Equals [5,2,2]', 'test 9 equals [5,2,2]'),
            new SubTask('2 Equals [2]', 'test 2 equals [2]'),
        ],
    ])->for(Course::factory()))->createQuietly();
});

it('returns 0 when 0 of 3 subtasks are complete', function () {
    expect($this->project->progress())->toBe(0);
});


it('returns 33 when 1 of 3 subtasks are complete', function () {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
        'sub_task_id' => 1,
    ]);
    $this->project->refresh();
    expect($this->project->progress())->toBe(33);
});

it('returns 67 when 2 of 3 subtasks are complete', function () {
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
    expect($this->project->progress())->toBe(67);
});

it('returns 100 when 3 of 3 subtasks are complete', function () {
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

it('returns 100 when project is finished and it has no sub-tasks', function () {
    $project = Project::factory()->finished()->for(Task::factory()->for(Course::factory()))->createQuietly();
    expect($project->progress())->toBe(100);
});

it('returns 0 when project is active and it has no sub-tasks', function () {
    $project = Project::factory()->active()->for(Task::factory()->for(Course::factory()))->createQuietly();
    expect($project->progress())->toBe(0);
});


it('has fallback for unknown grading type', function () {
    Log::spy();

    /** @var Task $task */
    $task = Task::factory()->for(Course::factory())->create();
    $task->module_configuration->addModule(AutomaticGrading::class);
    $settings = new AutomaticGradingSettings();
    $settings->gradingType = 'unknown';
    $task->module_configuration->update(AutomaticGrading::class, $settings, $task);
    $task->save();

    /** @var Project $project */
    $project = Project::factory()->for($task)->createQuietly();

    Log::shouldReceive('error')->once()->withArgs(["Unknown grading type for project {$project->id}, returning 0 progress"]);
    expect($project->progress())->toBe(0);

})->skip('Figure out why this breaks 125 other tests');
