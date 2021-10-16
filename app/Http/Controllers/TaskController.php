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
use Domain\Analytics\Graph\Line\LineDataSet;
use Domain\Analytics\Graph\Line\LineGraph;
use Gitlab\ResultPager;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function show(Course $course, Task $task)
    {
        $user        = User::firstWhere(['guid' => auth()->id()]);
        $project     = $task->projects()->firstWhere('ownable_id', $user->id);
        $startDay    = $task->starts_at->format("j/n");
        $endDay      = $task->ends_at->format("j/n");
        $percent     = number_format(now()->diffInSeconds($task->starts_at) / $task->starts_at->diffInSeconds($task->ends_at) * 100, 2);
        $progress    = $percent > 100 ? 100 : $percent;
        $timeLeft    = $task->ends_at->isPast() ? '' : str_replace('from now', 'left', $task->ends_at->diffForHumans());
        $myBuilds    = $task->dailyBuilds($user->id, false, false);
        $dailyBuilds = $task->dailyBuilds(null, true, false);

        $dailyBuildsGraph = new LineGraph($dailyBuilds->keys(),
            new LineDataSet("Total", $dailyBuilds, "#6B7280"),
            new LineDataSet("You", $myBuilds, "#7BB026")
        );
        $newProjectRoute  = route('courses.tasks.createProject', [$course->id, $task->id]);

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
            'buildGraph'      => $dailyBuildsGraph,
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
        $projectsToday   = $task->projects()->whereRaw('date(created_at) = ?', now()->toDateString())->count();
        $finishedCount   = $task->projects()->where('status', 'finished')->count();
        $finishedPercent = $finishedCount / $projectCount * 100;
        $failedCount     = $task->projects()->where('status', 'failed')->count();
        $failedPercent   = $failedCount / $projectCount * 100;
        $buildCount      = $task->jobs()->count();
        $buildsToday     = $task->jobs()->whereRaw("date(job_statuses.created_at) = ?", now()->toDateString())->withTrashedParents()->count();

        $totalProjectsPerDay      = $task->totalProjectsPerDay;
        $projectsCompletedPerDay  = $task->totalCompletedTasksPerDay;
        $totalProjectsPerDayGraph = new LineGraph($totalProjectsPerDay->keys(),
            new LineDataSet("Projects", $totalProjectsPerDay, "#266ab0"),
            new LineDataSet("Completed", $projectsCompletedPerDay, "#7BB026")
        );


        $dailyBuilds      = $task->dailyBuilds(null, true, true);
        $dailyBuildsGraph = new LineGraph($dailyBuilds->keys(), new LineDataSet("Builds", $dailyBuilds, "#6B7280"));

        return view('tasks.analytics', compact('course', 'task', 'projectCount',
            'projectsToday', 'finishedCount', 'finishedPercent', 'failedCount', 'failedPercent', 'buildCount', 'buildsToday', 'totalProjectsPerDayGraph', 'dailyBuildsGraph'));
    }
}
