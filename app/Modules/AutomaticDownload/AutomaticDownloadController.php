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
use Illuminate\View\View;
use Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use ZipStream\ZipStream;

class AutomaticDownloadController extends BaseController
{
    public function index(Course $course, Task $task): View
    {
        $projects = $task->projects()->claimed()->with('download', 'ownable')->get()->sort(fn(Project $a, Project $b) => strcmp($a->ownable->name, $b->ownable->name))->values();
        $enabledAfterDeadline = $task->downloads()->count() == 0;
        $downloads = $projects->map(fn(Project $project) => [
            'project'       => $project,
            'ownableName'   => $project->ownable->displayName(),
            'download'      => $project->download,
            'indexed'       => false,
        ]);

        $missingOnDisk = $downloads->filter(function($download) {
            /** @var ProjectDownload $projectDownload */
            $projectDownload = $download['download'];
            if ($projectDownload == null)
            {
                return true;
            }

            return $projectDownload->state == DownloadState::Downloaded && $projectDownload->queued_at == null;
        });

        return view('module-AutomaticDownload::index')->with('downloads', $downloads)->with('missing', $missingOnDisk)->with('enabledAfterDeadline', $enabledAfterDeadline);
    }

    public function download(Course $course, Task $task, ProjectDownload $projectDownload): StreamedResponse
    {
        return new StreamedResponse(function() use ($projectDownload) {
            $zip = new ZipStream(
                defaultEnableZeroHeader: true,
                outputName: str($projectDownload->project->ownable->name)->slug()->append("-$projectDownload->ref")->append(".zip"),
                contentType: 'application/octet-stream'
            );

            $allFiles = Storage::allFiles($projectDownload->location);
            foreach($allFiles as $file)
            {
                $innerPath = str($file)->remove($projectDownload->location)->ltrim('/')->toString();
                $zip->addFileFromPath(fileName: $innerPath, path: Storage::path($file));
            }

            $zip->finish();
        });
    }

    public function queue(Course $course, Task $task, ProjectDownload $projectDownload)
    {
        $projectDownload->update([
            'queued_at' => now(),
        ]);
        $projectDownload->queue();

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
                'queued_at' => now(),
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
                $download->update([
                    'queued_at' => now(),
                ]);
                $download->queue($downloadMinute);
            });

        return redirect()->back();
    }
}
