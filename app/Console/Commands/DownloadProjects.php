<?php

namespace App\Console\Commands;

use App\Jobs\Project\DownloadProject;
use App\Models\Project;
use App\Models\ProjectDownload;
use App\Models\ProjectPush;
use App\Models\Task;
use Illuminate\Console\Command;
use Ramsey\Collection\Collection;

class DownloadProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queues projects that need to be downloaded';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $eligibleTasks_DEPRECATED = Task::whereIn('correction_type', ['manual'])->pluck('ends_at', 'id'); // This is deprecated... But not removed yet TODO:Remove this line when all old tasks have been deleted
        $eligibleTasks = Task::whereJsonContains("module_configuration->BuildTracking->enabled", true)->pluck('ends_at', 'id'); // This is the new way of doing it
        $eligibleTasks->merge($eligibleTasks_DEPRECATED);
        $projects = Project::whereIn('task_id', $eligibleTasks->keys())->get();
        $queuedCount = ProjectDownload::queued()->count();

        /** @var Project $project */
        foreach($projects as $project)
        {
            /** @var ProjectPush | null $latestPush */
            $latestPush = $project->pushes()
                ->where('created_at', '<=', $eligibleTasks[$project->task_id])->latest()->first();

            if ($latestPush == null)
            {
                $this->info("[Project $project->repo_name] No pushes prior to the deadline. Skipping.");
                continue;
            }

            if (ProjectDownload::where('project_id', $project->id)->where('ref', $latestPush->after_sha)->exists())
            {
                $this->info("[Project $project->repo_name] Already been downloaded. Skipping.");
                continue;
            }

            $projectDownload = $project->download()->create([
                'ref'       => $latestPush->after_sha,
                'expire_at' => now()->addYears(2),
            ]);
            $queuedCount++;

            /** Every three task is delayed by a minute to ensure we don't exceed the 5 downloads / min limit */
            dispatch(new DownloadProject($projectDownload))->delay(now()->addMinutes($queuedCount / 3));
            $this->info("[Project $project->repo_name] Queued download.");
        }

        return self::SUCCESS;
    }
}
