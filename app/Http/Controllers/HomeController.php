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


    public function reporter()
    {
        abort_unless(\request()->hasHeader('X-Gitlab-Token'), 400, 'No gitlab token supplied');
        $token         = \request()->header('X-Gitlab-Token');
        $tokenShouldBe = md5(strtolower(\request('repository.name')) . "webtechf21");
        abort_unless($token == $tokenShouldBe, 400, 'Token mismatch');

        $jobStatus             = JobStatus::where([
            'build_id'   => request('build_id'),
            'project_id' => request('project_id')
        ])->firstOrNew();
        $jobStatus->build_id   = request('build_id');
        $jobStatus->project_id = request('project_id');
        $jobStatus->status     = \request('build_status');
        if ($jobStatus->log == null)
            $jobStatus->log = [];
        if ($jobStatus->history == null)
            $jobStatus->history = [];
        $jobStatus->repo_branch = request('ref');
        $jobStatus->repo_name   = \request('repository.name');
        if (\request('build_duration') != null)
            $jobStatus->duration = \request('build_duration');
        if (\request('build_queued_duration') != null)
            $jobStatus->queue_duration = \request('build_queued_duration');
        if (\request('runner') != null)
            $jobStatus->runner = \request('runner.description');

        $logs = collect($jobStatus->log);
        $logs->push(request()->toArray());
        $history = collect($jobStatus->history);

        $history->push([
            'status'      => \request('build_status'),
            'created_at'  => \request('build_created_at') == null ? null : Carbon::parse(\request('build_created_at')),
            'started_at'  => \request('build_started_at') == null ? null : Carbon::parse(\request('build_started_at')),
            'finished_at' => \request('build_finished_at') == null ? null : Carbon::parse(\request('build_finished_at')),
        ]);
        $jobStatus->log     = $logs;
        $jobStatus->history = $history;
        $jobStatus->save();


        return response("ok", 200);
    }
}
