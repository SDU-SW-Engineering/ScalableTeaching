<?php

namespace App\Console\Commands;

use App\Models\Enums\CorrectionType;
use App\Models\Project;
use App\Models\Task;
use App\Modules\MarkAsDone\MarkAsDone;
use App\Modules\Template\Template;
use App\ProjectStatus;
use Illuminate\Console\Command;

class MarkExpiredProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:mark-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Goes through all of the tasks and marks the ones that are overdue.';

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
     */
    public function handle() : int
    {
        $tasks = Task::where('is_visible', true)->get();
        /** @var Task $task */
        foreach ($tasks as $task)
        {
            $this->info("Marking tasks under [{$task->course->name}] $task->name");
            $overDueTime = $task->ends_at->addMinutes(5);

            if ( ! now()->isAfter($overDueTime)){
                continue;
            }

            if (!$task->module_configuration->isEnabled(MarkAsDone::class) && !$task->module_configuration->isEnabled(Template::class)){
                $this->info("Skipping task $task->name ($task->id). This task is not completable and can thus not be finished nor overdue.");
                continue;
            }

            $count = $task->projects()->where('status', 'active')->withTrashed()->each(function(Project $project) {
                if ($project->pushes()->count() == 0){ // If a project has no pushes, and we are after the deadline then the project must not have been handed in thus we set it to overdue
                    $project->setProjectStatus(ProjectStatus::Overdue);
                } else { // If there are pushes, and we are after the deadline then the project must be finished
                    $project->setProjectStatus(ProjectStatus::Finished);
                }
            });
            $this->info("Marked $count projects as overdue for task $task->name ($task->id).");
        }

        return 0;
    }
}
