<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use DB;
use Illuminate\Console\Command;

class DelegateTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:delegate
    {tasks* : The tasks that should be delegated}
    {--user=* : The users that the tasks should be delegated to.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $users = collect($this->option('user'))->map(fn($userId) => User::find($userId));

        if ($users->count() == 0)
        {
            $this->error('No users specified.');

            return self::FAILURE;
        }

        $tasks = Task::whereIn('id', $this->argument('tasks'))->get();
        $projects = Project::whereIn('task_id', $this->argument('tasks'))
            ->get()->filter(fn(Project $project) => $project->latestDownload() !== false);

        $taskNames = $tasks->map(fn(Task $task) => $task->name)->join(', ');
        $confirmed = $this->confirm("{$projects->count()} projects from task(s) [$taskNames] will be delegated between " . $users->map(fn(User $user) => $user->name)->join(', '));

        if ($confirmed == false)
        {
            $this->info("Operation canceled.");

            return self::SUCCESS;
        }

        DB::table('grade_delegations')->whereIn('project_id', $projects->pluck('id'))->delete();
        $splits = $projects->shuffle()->split($users->count());
        foreach($users as $index => $user)
        {
            $user->gradeDelegations()->createMany($splits[$index]->map(fn(Project $project) => [
                'project_id' => $project->id,
            ]));
        }
        $this->info("Tasks delegated!");

        return self::SUCCESS;
    }

}
