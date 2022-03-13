<?php

namespace App\Jobs\Project;

use App\Models\Project;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DownloadProject implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    public $backoff = [60, 120, 300, 600];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Project $project, private string $ref)
    {
    }

    public function handle()
    {
        $gitLabManager = app(GitLabManager::class);

        $archiveContent = $gitLabManager->repositories()->archive($this->project->project_id, [
            'id' => $this->ref
        ], 'zip');
        \Storage::disk('local')->put("tasks/{$this->project->task_id}/projects/{$this->project->id}_{$this->ref}.zip", $archiveContent);
    }
}
