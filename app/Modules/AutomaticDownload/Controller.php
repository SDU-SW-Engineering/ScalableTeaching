<?php

namespace App\Modules\AutomaticDownload;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\Enums\DownloadState;
use App\Models\Project;
use App\Models\ProjectDownload;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class Controller extends BaseController
{
    public function index(Course $course, Task $task)
    {
        $projects = $task->projects()->claimed()->with('downloads', 'ownable')->get()->sort(fn(Project $a, Project $b) => strcmp($a->ownable->name, $b->ownable->name))->values();
        $enabledAfterDeadline = $task->downloads()->count() == 0;
        $downloads = $projects->map(fn(Project $project) => [
            'project'  => $project,
            'download' => $project->downloads()->first(),
            'indexed'  => false
        ]);
        $missingOnDisk = $downloads->filter(fn($download) => $download['download']?->state == DownloadState::Downloaded && $download['download']->queued_at == null);
        return view('module-AutomaticDownload::index')->with('downloads', $downloads)->with('missing', $missingOnDisk)->with('enabledAfterDeadline', $enabledAfterDeadline);
    }

    public function download(Course $course, Task $task, ProjectDownload $projectDownload)
    {
        return \Storage::download($projectDownload->location, str($projectDownload->project->ownable->name)->slug()->append("-$projectDownload->ref")->append('.zip'));
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
            $push = $project->relevantPushes()->first();
            /** @var ProjectDownload $download */
            $download = $project->downloads()->create([
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
        $projects = $task->projects()->claimed()->has('downloads')->with('downloads', 'ownable')->get();
        $downloads = $projects->map(fn(Project $project) => $project->downloads()->first());
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
