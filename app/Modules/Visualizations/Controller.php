<?php

namespace App\Modules\Visualizations;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\Enums\DownloadState;
use App\Models\Project;
use App\Models\ProjectDownload;
use App\Models\Task;
use App\Models\VisualizationServer;
use App\Modules\Module;
use Gitlab\Api\Jobs;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use ZipArchive;
use function _PHPStan_9a6ded56a\React\Promise\Timer\timeout;
use Exception;

class Controller extends BaseController
{
    public function visualizations(Course $course, Task $task, Module $module)
    {
        $projects = $task->projects()->claimed()->with('downloads', 'ownable')->get()->sort(fn(Project $a, Project $b) => strcmp($a->ownable->name, $b->ownable->name))->values();
        $enabledAfterDeadline = $task->downloads()->count() == 0;
        $downloads = $projects->map(fn(Project $project) => [
            'project'  => $project,
            'download' => $project->downloads()->first(),
            'indexed'  => false
        ]);
        $missingOnDisk = $downloads->filter(fn($download) => $download['download']?->state == DownloadState::Downloaded && $download['download']->queued_at == null);
        return view('module-Visualizations::Pages.visualizations')->with('downloads', $downloads)->with('missing', $missingOnDisk)->with('enabledAfterDeadline', $enabledAfterDeadline);
    }


    public function showVisualization(Course $course, Task $task, VisualizationServer $visualizationServer, ProjectDownload $projectDownload)
    {
        //$originalPath = Storage::path($task->downloads()->pluck('location')->last());
        //dd($projectDownload->id);
        $originalPath = Storage::path($task->downloads()->where('project_downloads.id', $projectDownload->id)->pluck('location'));
        //dd($originalPath);
        $shinyPath = ':/srv/shiny-server/';
        $process = new Process(['docker', 'run', '--rm', '-v', $originalPath . $shinyPath, '-d', '-p', '3838:3838', 'christen97/shiny-server:firsttry']);
        //dd($process->getCommandLine());
        $process->run();
        $projectID = $task->downloads()->where('project_downloads.id', $projectDownload->id)->pluck('project_downloads.project_id');
        $visualizationServer = new VisualizationServer;
        $visualizationServer->container_id = str($process->getOutput())->trim();
        $visualizationServer->project_id = $projectID->first();
        $visualizationServer->deadline = now()->addSeconds(30);
        $visualizationServer->save();

        try
        {
            \Http::get('localhost:3838')->status();
        } catch (\Exception $e)
        {
            sleep(1);
            redirect()->back();
        }

        return view('module-Visualizations::Pages.showVisualization', compact('task', 'course', 'visualizationServer', 'projectDownload'));
    }

    public function presence(Course $course, Task $task, VisualizationServer $visualizationServer)
    {
        $visualizationServer->update([
            'deadline' => now()->addSeconds(30),
        ]);
    }

}
