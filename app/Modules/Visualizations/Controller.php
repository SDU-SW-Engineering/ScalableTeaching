<?php

namespace App\Modules\Visualizations;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\Project;
use App\Models\Task;
use App\Modules\Module;
use Gitlab\Api\Jobs;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use ZipArchive;
use function _PHPStan_9a6ded56a\React\Promise\Timer\timeout;

class Controller extends BaseController
{
    public function visualizations(Course $course, Task $task, Module $module)
    {
        $projectQuery = $task->projects()
            ->select('*', \DB::raw('TIMESTAMPDIFF(second,created_at, finished_at) as duration'))
            ->withCount('pipelines')
            ->orderBy(request('sort', 'created_at'), request('direction', 'desc'));

        $projects = $projectQuery->paginate(10)->withQueryString();

        return view('module-Visualizations::Pages.visualizations', compact('task', 'projects', 'course'));
    }

    public function showVisualization(Course $course, Task $task)
    {
        $originalPath = $task->downloads()->pluck('location')->first();
        $ref = $task->downloads()->pluck('ref')->first();
        $repoName = Project::findOrFail($task->downloads()->pluck('project_downloads.project_id')->first())->repo_name;

        if ( ! Storage::exists('newDir'))
        {
            Storage::makeDirectory('newDir');
        }

        $pathToP1 = Storage::path('newDir/') . $repoName . '-' . $ref . '-' . $ref . '/P1';
        $shinyPath = ':/srv/shiny-server/';
        $zip = new ZipArchive;
        if ($zip->open(Storage::path($originalPath)) === TRUE)
        {
            $zip->extractTo((Storage::path('newDir')));
            $zip->close();
            //Storage::move($originalPath, $baseDir);
            //return redirect()->back();
        } else
        {
            echo 'failed';
        }

        $process = new Process(['docker', 'run', '--rm', '-v', $pathToP1 . $shinyPath, '-d', '-p', '3838:3838', 'christen97/shiny-server:firsttry']);

        //dd(str($process->getCommandLine())->remove('\''));
        $process->run();

        /*if (!$process->isSuccessful()) {
            dd($process->getExitCode());
        }*/
        //check if server is running and reload

        //check if the user is on the page
        /*if (\Route::currentRouteAction() == "App\Modules\Visualizations\Controller@showVisualization")
        {
            dd(123);
        }*/
        echo $process->getOutput();
        try
        {
            $response = \Http::get('localhost:3838');
            echo $response;
        } catch (\Exception $e)
        {
            echo $e;
        }
        //$response = \Http::get('localhost:3838')->failed();
        /*if (!$response == 200) {
            redirect()->back();
        }*/
        //dd($response);
        return view('module-Visualizations::Pages.showVisualization', compact('task', 'course'));
    }

}
