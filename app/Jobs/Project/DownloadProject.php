<?php

namespace App\Jobs\Project;

use App\Models\ProjectDownload;
use GrahamCampbell\GitLab\GitLabManager;
use Http\Client\Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
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
        Log::info("Handling download for project {$this->download->project_id} with ref {$this->download->ref}");
        if($this->download->downloaded_at != null && $this->download->queued_at == null)
        {
            Log::debug("Download for project {$this->download->project_id} with ref {$this->download->ref} already downloaded. Skipping.");

            return;
        }

        $gitLabManager = app(GitLabManager::class);

        try
        {
            $archiveContent = $gitLabManager->repositories()->archive($this->download->project->gitlab_project_id, [
                'sha' => $this->download->ref,
            ], 'zip');
        } catch (\Exception $e)
        {
            Log::error("Something went wrong while getting the archive of project {$this->download->project_id} with ref {$this->download->ref}", [
                'exception' => $e,
            ]);

            return;
        }

        $tempName = "temp" . str()->random(4);
        $basePath = "tasks/{$this->download->project->task_id}/projects";
        $tempZipLocation = "$basePath/$tempName.zip";
        Storage::disk('local')->put($tempZipLocation, $archiveContent);

        $zip = new ZipArchive();
        $zip->open(Storage::path($tempZipLocation));
        $zipBaseDir = $zip->getNameIndex(0);
        $zip->extractTo(Storage::path("$basePath"));
        $fileLocation = "$basePath/{$this->download->project_id}_{$this->download->ref}";
        Storage::move("$basePath/$zipBaseDir", "$fileLocation");
        Storage::delete($tempZipLocation);

        $this->download->update([
            'location'      => $fileLocation,
            'downloaded_at' => now(),
            'queued_at'     => null,
        ]);
    }
}
