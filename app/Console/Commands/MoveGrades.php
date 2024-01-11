<?php

namespace App\Console\Commands;

use App\Models\Grade;
use App\Models\Project;
use App\Models\Task;
use App\ProjectStatus;
use Exception;
use Illuminate\Console\Command;

class MoveGrades extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:move-grades';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Moves grades to the grading table';

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
     * @throws Exception
     */
    public function handle()
    {
        foreach(Project::all() as $project)
        {
            if($project->ownable_type == null)
                continue;
            foreach($project->owners() as $owner)
            {
                if ($project->status == ProjectStatus::Active)
                    continue;
                Grade::firstOrCreate([
                    'task_id'     => $project->task_id,
                    'user_id'     => $owner->id,
                    'source_type' => Task::class,
                    'source_id'   => $project->task_id,
                    'value'       => match ($project->status)
                    {
                        ProjectStatus::Overdue  => 'failed',
                        ProjectStatus::Finished => 'passed'
                    },
                ]);
            }
        }

        return Command::SUCCESS;
    }
}
