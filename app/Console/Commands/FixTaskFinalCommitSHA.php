<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\ProjectStatus;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FixTaskFinalCommitSHA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:fixFinalCommitSHA {task : The id of the task to fix}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns all projects of a task the correct final commit SHA (If one exists)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $taskID = $this->argument('task');
        $task = Task::find($taskID);
        if ( ! $task)
        {
            $this->error("Task {$taskID} not found.");

            return Command::FAILURE;
        }

        $projects = $task->projects;
        if ($projects->isEmpty())
        {
            $this->error("No projects found for task {$task->name} (id: {$taskID})");

            return Command::FAILURE;
        }

        if (now()->isBefore($task->ends_at))
        {
            $this->error("The project has not yet ended, and the final commit SHA can therefor not be set. Task ends at {$task->ends_at}");

            return Command::FAILURE;
        }

        foreach ($projects as $project)
        {

            if ($project->final_commit_sha != null)
            {
                continue; // Skips if a project already has a final SHA
            }
            $lastPush = $project->pushes()->whereDate("created_at", "<=", $task->ends_at)->orderBy("created_at", "desc")->limit(1)->first();
            $project->final_commit_sha = $lastPush->after_sha;
            $project->status = ProjectStatus::Finished;
            /** @var \Illuminate\Support\Carbon $taskEndsAt */
            $taskEndsAt = $task->ends_at;
            $project->finished_at = $taskEndsAt; // Since we don't have an exact finished at time, this is the best estimate
            $project->save();
        }

        return Command::SUCCESS;
    }
}
