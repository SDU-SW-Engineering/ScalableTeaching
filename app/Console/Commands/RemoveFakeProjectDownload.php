<?php

namespace App\Console\Commands;

use App\Models\ProjectDownload;
use App\Models\Task;
use Illuminate\Console\Command;

class RemoveFakeProjectDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:RemoveFakeProjectDownload {task : The id of the task with broken downloads}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will remove ProjectDownload instances from projects where the download was unsuccessful';

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
        $hasDeletedAny = false;
        foreach ($projects as $project)
        {
            if ( ! $project->download()->exists())
            {
                continue;
            }

            /** @var ProjectDownload $download */
            $download = $project->download()->first();
            $fileLocation = "tasks/{$project->task_id}/projects/{$project->id}_{$download->ref}";
            if ( ! file_exists($fileLocation))
            {
                $this->info("Download not found for project {$project->id}... Deleting ProjectDownload");
                $download->delete();
                $hasDeletedAny = true;
            }
        }
        if ($hasDeletedAny)
        {
            $this->warn("Fake downloads was found and has been deleted.\nIt is recommended to run the \"projects:download\" command to get them downloaded");
        } else
        {
            $this->info("No fake downloads were found");
        }

        return Command::SUCCESS;
    }
}
