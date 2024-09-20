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
use function Pest\Laravel\postJson;
use function Pest\testDirectory;

uses(RefreshDatabase::class);

beforeEach(function() {
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
    $settings->gradingType = AutomaticGradingType::ALL_SUBTASKS->value;
    $task->module_configuration->update(AutomaticGrading::class, $settings, $task);
    $task->save();

    $this->project = Project::factory()->for($task)->createQuietly();

    // We use pipeline for the last task, since that is the only "true" way to complete a task with all subtasks, since grading is then handled by pipelines.
    $this->pipelineFailedRequest = json_decode(file_get_contents(testDirectory('Feature/GitLab/Stubs/Pipeline3.json')), true);
    $this->pipelineFailedRequest['project']['id'] = $this->project->gitlab_project_id;
    $this->pipelineSucceedingRequest = json_decode(file_get_contents(testDirectory('Feature/GitLab/Stubs/Pipeline4.json')), true);
    $this->pipelineSucceedingRequest['project']['id'] = $this->project->gitlab_project_id;
});

it('ensures projects to be active when no subtasks are complete', function() {
    expect($this->project->status)->toEqual(ProjectStatus::Active);
});


it('ensures projects to be active when 1 of 3 subtask are complete', function() {
    $this->project->subTasks()->create([
        'source_type' => Pipeline::class,
        'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
        'sub_task_id' => 1,
    ]);
    expect($this->project->status)->toEqual(ProjectStatus::Active);
});

it('ensures projects to be active when 2 of 3 subtask are complete', function() {
    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ],
    ]);
    $this->project->refresh();
    expect($this->project->status)->toEqual(ProjectStatus::Active);
});

it('ensures projects to be finished when 3 of 3 subtask are complete', function() {
    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ],
    ]);
    $this->project->refresh();
    expect($this->project->status)->toEqual(ProjectStatus::Finished);
});

it('ensures project can go from finished to active if all tasks were completed but no longer is', function() {
   sendSucceedingPipeline();
    $this->project->refresh();
    expect($this->project->status)->toEqual(ProjectStatus::Finished);

    sendFailedPipeline();
    $this->project->refresh();
    expect($this->project->status)->toEqual(ProjectStatus::Active);
});
