<?php

namespace App\Modules\AutomaticDownload;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\Enums\DownloadState;
use App\Models\Project;
use App\Models\ProjectDownload;
use App\Models\ProjectPush;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Storage;
use ZipStream\Exception\FileNotFoundException;
use ZipStream\Exception\FileNotReadableException;
use ZipStream\Option\Archive;
use ZipStream\ZipStream;

class Controller extends BaseController
{
    public function index(Course $course, Task $task)
    {
        $projects = $task->projects()->claimed()->with('download', 'ownable')->get()->sort(fn(Project $a, Project $b) => strcmp($a->ownable->name, $b->ownable->name))->values();
        $enabledAfterDeadline = $task->download()->count() == 0;
        $downloads = $projects->map(fn(Project $project) => [
            'project'  => $project,
            'download' => $project->download,
            'indexed'  => false
        ]);
        $missingOnDisk = $downloads->filter(fn($download) => $download['download']?->state == DownloadState::Downloaded && $download['download']->queued_at == null);
        return view('module-AutomaticDownload::index')->with('downloads', $downloads)->with('missing', $missingOnDisk)->with('enabledAfterDeadline', $enabledAfterDeadline);
    }

    /**
     * @throws FileNotFoundException
     * @throws FileNotReadableException
     */
    public function download(Course $course, Task $task, ProjectDownload $projectDownload)
    {
        $name = str($projectDownload->project->ownable->name)->slug()->append("-$projectDownload->ref")->append('.zip');
        $options = new Archive();
        $options->setSendHttpHeaders(true);
        $zip = new ZipStream($name, $options);
        $files = Storage::allFiles($projectDownload->location);
        foreach($files as $file)
        {
            $internalPath = str($file)->remove($projectDownload->location)->ltrim('/')->toString();
            $zip->addFileFromPath($internalPath, Storage::path($file));
        }

        $zip->finish();
        //return Storage::download($projectDownload->location, str($projectDownload->project->ownable->name)->slug()->append("-$projectDownload->ref"));
    }

    public function queue(Course $course, Task $task, ProjectDownload $projectDownload)
    {
        $projectDownload->queue();
        $projectDownload->update([
            'queued_at' => now()
        ]);

        return redirect()->back();
    }

    public function createDownloads(Course $course, Task $task)
    {
        $task->projects()->get()->filter(fn(Project $project) => $project->relevantPushes()->exists())->each(function(Project $project, $index) {
            /** @var ProjectPush $push */
            $push = $project->relevantPushes()->first();
            /** @var ProjectDownload $download */
            $download = $project->download()->create([
                'ref'       => $push->after_sha,
                'expire_at' => now()->addYears(2),
                'queued_at' => now()
            ]);
            $downloadMinute = (int)($index / 3);
            $download->queue($downloadMinute);
        });

        return redirect()->back();
    }

    public function queueAll(Course $course, Task $task)
    {
        /** @var Collection<Project> $projects */
        $projects = $task->projects()->claimed()->has('download')->with('download', 'ownable')->get();
        $downloads = $projects->map(fn(Project $project) => $project->download); // @phpstan-ignore-line
        $downloads
            ->filter(fn(ProjectDownload $download) => $download->state == DownloadState::Downloaded && $download->queued_at == null)
            ->values()
            ->each(function(ProjectDownload $download, int $index) {
                $downloadMinute = (int)($index / 3);
                $download->queue($downloadMinute);
                $download->update([
                    'queued_at' => now()
                ]);
            });

        return redirect()->back();
    }
}
