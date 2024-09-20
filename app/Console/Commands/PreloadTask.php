<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Modules\PreloadRepositories\PreloadRepositories;
use App\Modules\PreloadRepositories\PreloadRepositoriesSettings;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class PreloadTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:preload {task? : The ID of the task to preload, if none provided will check all tasks} {--f|force : Whether to force the preload, even if the task already has projects}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Preloads a task for a given availability percentage. If no task is provided, will preload all tasks, if the start time is less than 6 hours in the future.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $taskId = $this->argument('task');
        $tasks = new Collection();
        if ($taskId)
        {
            try
            {
                $tasks->add(Task::findOrFail($taskId));
            } catch (\Exception $e)
            {
                $this->error("Task with id {$taskId} was not found.");

                return -1;
            }
        } else
        {
            $tasks = Task::where('starts_at', '<', now()->addHours(6))
                ->where('starts_at', '>', now())
                ->get();
        }

        if ($tasks->count() === 0)
        {
            $this->info("No tasks to preload.");

            return 0;
        }

        $this->withProgressBar($tasks, function (Task $task) {
            $this->preloadTask($task);
        });

        return 0;
    }

    private function preloadTask(Task $task): void
    {

        /**
         * @var PreloadRepositoriesSettings|null $preloadModuleSettings
         */
        $preloadModuleSettings = $task->module_configuration->resolveModule(PreloadRepositories::class)?->settings();

        if ( ! $preloadModuleSettings)
        {
            return;
        }

        if ($task->projects()->count() > 0 && ! $this->option('force'))
        {
            $this->warn("Task \"{$task->name}\" ({$task->id}) has projects, or was already preloaded. Use --force to override.");

            return;
        }

        $projectAvailability = $preloadModuleSettings->availability;

        $this->info("Preloading task {$task->name} ({$task->id}) for {$projectAvailability}% availability...");
        $task->preload($projectAvailability);
        $this->info("Successfully preloaded task {$task->name} ({$task->id})");
    }
}
