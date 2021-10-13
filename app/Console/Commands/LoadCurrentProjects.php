<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Gitlab\ResultPager;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Console\Command;
use function Clue\StreamFilter\fun;

class LoadCurrentProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gitlab:load-projects {group}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load projects into the database';

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
        $groupId     = $this->argument('group');
        $manager     = app(GitLabManager::class);
        $resultPager = new ResultPager($manager->connection());
        $projects    = collect($resultPager->fetchAll($manager->groups(), 'projects', [$groupId]));
        $this->info("Discovered {$projects->count()} projects within the group.");
        $task = Task::findOrFail($this->ask('What task does the projects belong to'));
        $this->withProgressBar($projects, function ($project) use ($task)
        {
            $task->projects()->updateOrCreate([
                'project_id' => $project['id']
            ], [
                'repo_name'  => $project['name'],
                'created_at' => Carbon::parse($project['created_at'])->setTimezone(config('app.timezone'))
            ]);
        });

        return 0;
    }
}
