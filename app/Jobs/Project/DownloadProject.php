<?php

namespace App\Jobs\Project;

use App\Models\ProjectDownload;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;
use ZipArchive;

class DownloadProject implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 5;

    /**
     * @var int[]
     */
    public array $backoff = [60, 120, 300, 600];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly ProjectDownload $download)
    {
    }

    public function handle(): void
    {
        if($this->download->downloaded_at != null && $this->download->queued_at == null)
            return;

        $gitLabManager = app(GitLabManager::class);

        $archiveContent = $gitLabManager->repositories()->archive($this->download->project->project_id, [
            'sha' => $this->download->ref,
        ], 'zip');

        $tempName = "temp" . str()->random(4);
        $basePath = "tasks/{$this->download->project->task_id}/projects";
        $fileLocation = "$basePath/$tempName.zip";
        Storage::disk('local')->put($fileLocation, $archiveContent);

        $zip = new ZipArchive();
        $zip->open(Storage::path($fileLocation));
        $zipBaseDir = $zip->getNameIndex(0);
        $zip->extractTo(Storage::path("$basePath"));
        $newPath = "$basePath/{$this->download->project_id}_{$this->download->ref}";
        Storage::move("$basePath/$zipBaseDir", "$newPath");
        Storage::delete($fileLocation);

        $this->download->update([
            'location'      => $newPath,
            'downloaded_at' => now(),
            'queued_at'     => null,
        ]);
    }
}
