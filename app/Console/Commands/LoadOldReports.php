<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;

class LoadOldReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gitlab:load-old-reports {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loads a json file with reports into the database';

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
        $content = stripslashes(file_get_contents(storage_path($this->argument('file'))));
        $data    = collect(json_decode($content, true));

        $this->info("File contains {$data->count()} entries.");
        $this->withProgressBar($data, function ($entry)
        {
            $repoProjectId = $entry['project_id'];
            $project       = Project::firstWhere(['project_id' => $repoProjectId]);
            if ($project == null) {
                $this->info("Skipping $repoProjectId as it doesn't exist.");
                return;
            }

            $logs          = json_decode(str_replace(["\n", "\r", "\t"], '',  stripslashes($entry['log'])),true);
            $history       = json_decode(str_replace(["\n", "\r", "\t"], '',  stripslashes($entry['history'])),true);
            Project::unguarded(function () use ($history, $logs, $entry, $project)
            {
                $project->jobStatuses()->updateOrCreate([
                    'build_id' => $entry['build_id']
                ], [
                    'status'         => $entry['status'],
                    'repo_name'      => $entry['repo_name'],
                    'repo_branch'    => $entry['repo_branch'],
                    'user_name'      => $logs[0]['user']['name'],
                    'user_email'     => $logs[0]['user']['email'],
                    'runner'         => $entry['runner'],
                    'duration'       => $entry['duration'],
                    'queue_duration' => $entry['queue_duration'],
                    'log'            => $logs,
                    'history'        => $history,
                    'created_at'     => $logs[0]['build_created_at'] ?? $entry['created_at'],
                    'updated_at'     => $entry['updated_at']
                ]);
            });
        });

        return 0;
    }
}
