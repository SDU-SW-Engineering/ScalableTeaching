<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\JobStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Gitlab\ResultPager;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function show(Course $course, Task $task)
    {
        $user            = User::firstWhere(['guid' => auth()->id()]);
        $project         = $task->projects()->firstWhere('ownable_id', $user->id);
        $startDay        = $task->starts_at->format("j/n");
        $endDay          = $task->ends_at->format("j/n");
        $percent         = number_format(now()->diffInSeconds($task->starts_at) / $task->starts_at->diffInSeconds($task->ends_at) * 100, 2);
        $progress        = $percent > 100 ? 100 : $percent;
        $timeLeft        = $task->ends_at->isPast() ? '' : str_replace('from now', 'left', $task->ends_at->diffForHumans());
        $myBuilds        = $task->dailyBuilds($user->id);
        $dailyBuilds     = $task->dailyBuilds(null, true);
        $newProjectRoute = route('courses.tasks.createProject', [$course->id, $task->id]);

        return view('tasks.show', [
            'course'          => $course,
            'task'            => $task,
            'bg'              => 'bg-gray-50 dark:bg-gray-600',
            'project'         => $project,
            'progress'        => [
                'startDay' => $startDay,
                'endDay'   => $endDay,
                'percent'  => $progress,
                'timeLeft' => $timeLeft
            ],
            'builds'          => $dailyBuilds,
            'myBuilds'        => $myBuilds,
            'newProjectRoute' => $newProjectRoute
        ]);
    }

    public function doCreateProject(Course $course, Task $task, GitLabManager $gitLabManager)
    {

        $user    = User::firstWhere(['guid' => auth()->id()]);
        $project = $task->projects()->firstWhere('ownable_id', $user->id);
        abort_if($project != null, 409, 'A project has already been created for you.');
        $gitlabUser = collect($gitLabManager->users()->all([
            'username' => $user->username
        ]));


        abort_if($gitlabUser->isEmpty(), 409, 'Could not find your gitlab user. Log in to gitlab.sdu.dk and try again.');

        $projectId = $this->createProject($gitLabManager, $user->username, $user);

        $gitlabUserId = $gitlabUser->first()['id'];
        $added        = true;
        try
        {
            $gitLabManager->projects()->addMember($projectId, $gitlabUserId, 40);
        }
        catch (\Exception $e)
        {
            $added = Str::contains($e->getMessage(), 'Member already exists');
        }

        return "OK";
    }


    /**
     * @return int Project id
     */
    private function createProject(GitLabManager $manager, $username, User $user) : int
    {
        $resultPager = new ResultPager($manager->connection());
        $projects    = collect($resultPager->fetchAll($manager->groups(), 'projects', [1167]));
        $project     = $projects->firstWhere('name', $username);
        if ($project == null)
        {
            $project = $this->forkProject($manager, $username);
        }

        Project::updateOrCreate([
            'project_id' => $project['id']
        ], [
            'task_id'      => Task::first()->id,
            'repo_name'    => $project['name'],
            'ownable_id'   => $user->id,
            'ownable_type' => User::class
        ]);

        $currentHooks = collect($manager->projects()->hooks($project['id']));
        if ($currentHooks->isEmpty())
        {
            $manager->projects()->addHook($project['id'], 'http://23.88.33.213/forwarder.php', [
                'job_events'              => true,
                'token'                   => md5(strtolower($project['name']) . "webtechf21"),
                'enable_ssl_verification' => false
            ]);
        }

        return $project['id'];
    }

    private function forkProject(GitLabManager $manager, $username)
    {
        return $manager->projects()->fork(2557, [
            'namespace' => 'webtech/assignment-1',
            'name'      => $username,
            'path'      => $username
        ]);
    }

    public function analytics(Course $course, Task $task)
    {
        $projectCount    = $task->projects()->count();
        $projectsToday   = $task->projects()->whereRaw('date(created_at) = curdate()')->count();
        $finishedCount   = $task->projects()->where('status', 'finished')->count();
        $finishedPercent = $finishedCount / $projectCount * 100;
        $failedCount     = $task->projects()->where('status', 'failed')->count();
        $failedPercent   = $failedCount / $projectCount * 100;
        $buildCount      = $task->jobs()->count();
        $buildsToday     = $task->jobs()->whereRaw('date(job_statuses.created_at) = curdate()')->withTrashedParents()->count();

        $projectsCreatedPerDay      = $this->projectsPerDay($task);
        $projectsCreatedPerDayGraph = collect([
            'data'   => $projectsCreatedPerDay->pluck('count'),
            'labels' => $projectsCreatedPerDay->pluck('date')
        ]);

        $projectsCompletedPerDay      = $this->projectsCompletedPerDay($task, $projectCount);
        $projectsCompletedPerDayGraph = collect([
            'data'   => $projectsCompletedPerDay->pluck('percent'),
            'labels' => $projectsCompletedPerDay->pluck('date')
        ]);

        $dailyBuilds      = $task->dailyBuilds(null, true, true);
        $dailyBuildsGraph = collect([
            'data'   => $dailyBuilds,
            'labels' => $dailyBuilds->map(function ($val, $index)
            {
                return "Day " . ($index + 1);
            })
        ]);

        return view('tasks.analytics', compact('course', 'task', 'projectCount',
            'projectsToday', 'finishedCount', 'finishedPercent', 'failedCount', 'failedPercent', 'buildCount', 'buildsToday', 'projectsCompletedPerDayGraph', 'dailyBuildsGraph', 'projectsCreatedPerDayGraph'));
    }

    private function projectsPerDay(Task $task)
    {
        $projectsPerDay = $task->projects()->select(
            DB::raw('count(*) as c'),
            DB::raw('day(`projects`.`created_at`) as created_at_day'),
            DB::raw('month(`projects`.`created_at`) as created_at_month'),
            DB::raw('year(`projects`.`created_at`) as created_at_year'))
            ->groupBy('created_at_day', 'created_at_month', 'created_at_year')->withTrashed()->get()->mapWithKeys(function ($task)
            {
                return ["$task->created_at_year-$task->created_at_month-$task->created_at_day" => $task->c];
            });
        $projects       = collect();
        $endsAt         = now()->isAfter($task->ends_at) ? $task->ends_at : now();
        $dates          = CarbonPeriod::create($task->starts_at, $endsAt)->toArray();

        foreach ($dates as $date)
        {
            $dateString = $date->format('Y-n-j');
            $projects[] = [
                'date'  => $date->toDateString(),
                'count' => $projectsPerDay->has($dateString) ? $projectsPerDay[$dateString] : 0
            ];
        }

        return $projects;
    }

    private function projectsCompletedPerDay(Task $task, int $projectCount)
    {
        $projectsPerDay = $task->projects()->select(
            DB::raw('count(*) as c'),
            DB::raw('day(`projects`.`finished_at`) as finished_at_day'),
            DB::raw('month(`projects`.`finished_at`) as finished_at_month'),
            DB::raw('year(`projects`.`finished_at`) as finished_at_year'))
            ->groupBy('finished_at_day', 'finished_at_month', 'finished_at_year')->where('status', 'finished')->withTrashed()->get()->mapWithKeys(function ($task)
            {
                return ["$task->finished_at_year-$task->finished_at_month-$task->finished_at_day" => $task->c];
            });
        $projects       = collect();
        $endsAt         = now()->isAfter($task->ends_at) ? $task->ends_at : now();
        $dates          = CarbonPeriod::create($task->starts_at, $endsAt)->toArray();

        $carry = 0;
        foreach ($dates as $date)
        {
            $dateString = $date->format('Y-n-j');
            if ($projectsPerDay->has($dateString))
                $carry += $projectsPerDay[$dateString];

            $projects[] = [
                'date'    => $date->toDateString(),
                'percent' => round($carry / $projectCount * 100, 2, PHP_ROUND_HALF_UP)
            ];
        }

        return $projects;
    }
}
