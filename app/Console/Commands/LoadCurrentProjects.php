<?php

namespace App\Console\Commands;

use Gitlab\ResultPager;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Console\Command;

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
        $groupId = $this->argument('group');
        $manager = app(GitLabManager::class);
        $resultPager = new ResultPager($manager->connection());
        $projects    = collect($resultPager->fetchAll($manager->groups(), 'projects', [1167]));
        var_dump($projects);
    }
}
