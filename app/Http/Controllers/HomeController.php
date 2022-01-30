<?php

namespace App\Http\Controllers;

use App\Models\JobStatus;
use App\Models\Project;
use App\Models\Task;
use Cache;
use Carbon\Carbon;
use Gitlab\Client;
use Gitlab\ResultPager;
use GrahamCampbell\GitLab\Facades\GitLab;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Str;
use function Clue\StreamFilter\remove;

class HomeController extends Controller
{
    public function index()
    {
        $averageQueueTime = Cache::remember('queue1MonthAvg', 3600, function ()
        {
            return JobStatus::where('created_at', '>=', now()->subMonth()->toDateString())
                ->average('queue_duration');
        });

        $builds = Cache::remember('build1MonthCount', 3600, function ()
        {
            return JobStatus::where('created_at', '>=', now()->subMonth()->toDateString())->count();
        });

        $buildAverageTime = Cache::remember('build1MonthAvg', 3600, function ()
        {
            return JobStatus::where('created_at', '>=', now()->subMonth()->toDateString())
                ->average('duration');
        });

        $projectCount = Cache::remember('projectCount', 3600, function ()
        {
            return Project::count();
        });

        $assignmentCount = Cache::remember('assignmentCount', 3600, function ()
        {
            return Task::count();
        });

        return view('home', [
            'hideHeader'      => true,
            'avgQueue'        => $averageQueueTime,
            'buildCount'      => $builds,
            'buildAvg'        => $buildAverageTime,
            'projectCount'    => $projectCount,
            'assignmentCount' => $assignmentCount
        ]);
    }
}
