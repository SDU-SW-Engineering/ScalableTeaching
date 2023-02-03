<?php

namespace App\Console\Commands\Export;

use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;
use League\Csv\Writer;

class TaskStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:task-status {task}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a csv file of each students and their state of the given assignment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $task = Task::findOrFail($this->argument('task'));
        $csvWriter = Writer::createFromPath(storage_path(date('Y-m-d H:i:s')." - $task->name status.csv"), 'w');
        $csvWriter->insertOne(['name', 'email', 'task', 'group', 'status', 'validation_errors']);
        $task->projects->each(function (Project $project) use ($task, $csvWriter) {
            $project->owners()->each(function (User $user) use ($project, $task, $csvWriter) {
                $csvWriter->insertOne([
                    $user->name,
                    $user->email,
                    $task->name,
                    $project->ownable_type == Group::class ? $project->ownable->name : '',
                    $project->status->value,
                    implode($project->validation_errors ?? []),
                ]);
            });
        });

        return 0;
    }
}
