<?php

namespace App\Console\Commands;

use App\Models\Casts\SubTask;
use App\Models\GradeDelegation;
use App\Models\ProjectSubTask;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UpgradeSubtasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:upgrade-subtasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates subtask to reflect the new way to handle them';

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
        /** @var Task $task */
        $task = Task::find(14);

        $currentProgression = ProjectSubTask::all();
        $pickedFile = null;

        if($currentProgression->count() > 0) {
            $this->info("Saving current progression!");
            $fileName = "subtasks/progress" . date('Y-m-d H:i:s') . '.json';
            Storage::put("subtasks/progress/" . date('Y-m-d H:i:s') . '.json', $currentProgression->toJson(JSON_PRETTY_PRINT));

            if($this->confirm("Would you like to use this file?"))
                $pickedFile = $fileName;
        }

        if($pickedFile == null)
            $pickedFile = $this->choice("Pick an input file: ", Storage::files("subtasks/progress"));


        ProjectSubTask::query()->delete();
        $tasks = collect(json_decode(Storage::get($pickedFile), true))->groupBy('project_id');

        foreach($task->projects as $index => $project) {
            $completedTasks = $tasks->has($project->id)
                ? collect($tasks[$project->id])->keyBy('sub_task_id')
                : collect();
            $gradeDelegation = GradeDelegation::firstWhere('project_id', $project->id);

            if($gradeDelegation == null)
                continue;
            ProjectSubTask::insert($task->sub_tasks->all()->map(function(SubTask $subTask) use ($gradeDelegation, $project, $completedTasks) {
                return [
                    'project_id'  => $project->id,
                    'sub_task_id' => $subTask->getId(),
                    'points'      => $completedTasks->has($subTask->getId()) ? $subTask->points : 0,
                    'source_type' => GradeDelegation::class,
                    'source_id'   => $gradeDelegation->id
                ];
            })->toArray());
            $this->info("Created subtasks for project " . $project->id);
        }

        return 0;
    }
}
