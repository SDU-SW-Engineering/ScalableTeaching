<?php

use App\Jobs\Project\DownloadProject;
use App\Models\Course;
use App\Models\Project;
use App\Models\ProjectDownload;
use App\Models\Task;
use App\Modules\AutomaticDownload\AutomaticDownload;
use Carbon\Carbon;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;

uses(RefreshDatabase::class);

beforeEach(function() {
   Storage::fake('local');

   /** @var Task $task */
    $task = Task::factory([
         'starts_at' => Carbon::create(2022, 8, 8, 12),
         'ends_at'   => Carbon::create(2022, 8, 24, 23, 59),
    ])->for(Course::factory())->make();

    $task->module_configuration->addModule(AutomaticDownload::class);
    $task->save();
    $this->task = $task;

    $this->project = Project::factory([
        "task_id" => $task,
    ])->create();

});

it('should not call GitLab when the project has already been downloaded and not re-queued', function() {
    $projectDownload = ProjectDownload::factory([
        'downloaded_at' => Carbon::now(),
    ])->for($this->project)->create();

    $this->mock(GitLabManager::class, function (MockInterface $mock) {
        $mock->shouldNotHaveBeenCalled();
    });

    $job = new DownloadProject($projectDownload);
    $job->handle();
});

it('should call GitLab to fetch the archived version of the repository when project download has been re-queued', function() {
    /** @var ProjectDownload $projectDownload */
    $projectDownload = ProjectDownload::factory([
        'downloaded_at' => Carbon::now(),
        'queued_at'     => Carbon::now(),
    ])->for($this->project)->create();

    $this->mock(GitLabManager::class, function (MockInterface $mock) use ($projectDownload) {
        $mock->shouldReceive('repositories->archive')->once()->with($projectDownload->project->gitlab_project_id, [
            'sha' => $projectDownload->ref,
        ], 'zip')->andReturn('archive-content.zip');
    });

    $job = new DownloadProject($projectDownload);
    $job->handle();
});

it('should call GitLab to fetch the archived version of the repository when project download has been queued', function() {
    /** @var ProjectDownload $projectDownload */
    $projectDownload = ProjectDownload::factory([
        'downloaded_at' => null,
        'queued_at'     => Carbon::now(),
    ])->for($this->project)->create();

    $this->mock(GitLabManager::class, function (MockInterface $mock) use ($projectDownload) {
        $mock->shouldReceive('repositories->archive')->once()->with($projectDownload->project->gitlab_project_id, [
            'sha' => $projectDownload->ref,
        ], 'zip')->andReturn('archive-content.zip');
    });

    $job = new DownloadProject($projectDownload);
    $job->handle();
});

it('should store the downloaded archive in the local storage', function() {
    /** @var ProjectDownload $projectDownload */
    $projectDownload = ProjectDownload::factory([
        'downloaded_at' => null,
        'queued_at'     => Carbon::now(),
    ])->for($this->project)->create();

    $this->mock(GitLabManager::class, function (MockInterface $mock) use ($projectDownload) {
        $mock->shouldReceive('repositories->archive')->once()->with($projectDownload->project->gitlab_project_id, [
            'sha' => $projectDownload->ref,
        ], 'zip')->andReturn('archive-content.zip');
    });

    $job = new DownloadProject($projectDownload);
    $job->handle();

    Storage::disk('local')->assertExists("tasks/{$projectDownload->project->task_id}/projects/{$projectDownload->project_id}_{$projectDownload->ref}.zip");
});

it('should update the project downloads table, setting the location, downloaded_at and queued_at to null', function() {
    /** @var ProjectDownload $projectDownload */
    $projectDownload = ProjectDownload::factory([
        'downloaded_at' => null,
        'queued_at'     => Carbon::now(),
    ])->for($this->project)->create();

    // Guard
    expect($projectDownload->location)->toBeNull();
    expect($projectDownload->downloaded_at)->toBeNull();
    expect($projectDownload->queued_at)->not()->toBeNull();

    $this->mock(GitLabManager::class, function (MockInterface $mock) use ($projectDownload) {
        $mock->shouldReceive('repositories->archive')->once()->with($projectDownload->project->gitlab_project_id, [
            'sha' => $projectDownload->ref,
        ], 'zip')->andReturn('archive-content.zip');
    });

    $job = new DownloadProject($projectDownload);
    $job->handle();

    // Assert
    $projectDownload->refresh();
    expect($projectDownload->location)->toEqual("tasks/{$projectDownload->project->task_id}/projects/{$projectDownload->project_id}_{$projectDownload->ref}.zip");
    expect($projectDownload->downloaded_at)->not()->toBeNull();
    expect($projectDownload->queued_at)->toBeNull();
});


it('should handle errors from GitLab API gracefully', function() {
    /** @var ProjectDownload $projectDownload */
    $projectDownload = ProjectDownload::factory([
        'downloaded_at' => null,
        'queued_at'     => Carbon::now(),
    ])->for($this->project)->create();

    $this->mock(GitLabManager::class, function (MockInterface $mock) use ($projectDownload) {
        $mock->shouldReceive('repositories->archive')->once()->with($projectDownload->project->gitlab_project_id, [
            'sha' => $projectDownload->ref,
        ], 'zip')->andThrow(new \Exception('Mocked GitLab API error'));
    });

    $job = new DownloadProject($projectDownload);
    $job->handle();

    // Assert
    $projectDownload->refresh();
    expect($projectDownload->location)->toBeNull();
    expect($projectDownload->downloaded_at)->toBeNull();
    expect($projectDownload->queued_at)->not()->toBeNull();
});

?>
