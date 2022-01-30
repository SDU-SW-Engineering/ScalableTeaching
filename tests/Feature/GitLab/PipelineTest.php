<?php

use App\Models\Course;
use App\Models\Project;
use App\Models\Task;
use function Pest\Laravel\postJson;
use function Pest\testDirectory;

beforeEach(function() {
    $this->project = Project::factory()->for(Task::factory()->for(Course::factory()))->create();
    $this->pipelinePendingRequest = json_decode(file_get_contents(testDirectory('Feature/GitLab/Stubs/Pipeline1.json')), true);
});


it('only accepts request with correct GitLab headers', function ()
{
    postJson(route('reporter'))->assertStatus(400);
    postJson(route('reporter'), [], ['X-Gitlab-Event' => 'ok'])->assertStatus(400);
    postJson(route('reporter'), [], ['X-Gitlab-Token' => Project::token($this->project)])->assertStatus(400);
    postJson(route('reporter'), $this->pipelinePendingRequest, [
        'X-Gitlab-Event' => 'ok',
        'X-Gitlab-Token' => Project::token($this->project)
    ])->assertStatus(200);
})->only();

it('converts timestamps to the current timezone');

it('processes a pending pipeline request', function ()
{

});

it('requests info about pipelines that have gone stale', function ()
{

});

it('processes a running pipeline', function ()
{

});

it('processes a failing pipeline', function ()
{

});

it('processes a succeeding pipeline', function ()
{

});

it('ensures subtasks completion isn\'t overwritten should they fail in the future');

it('marks zero subtasks as complete when all builds fail');

it('marks one subtask as complete when one build succeeds');

it('marks the task as complete when all builds succeeds');

it('ignores build statuses that are not part of the specified subtasks');

it('ensures pending and running pipelines don\'t overwrite a finished pipeline');

it('ensures running pipelines don\'t overwrite a running or finished pipeline');

