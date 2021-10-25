<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\CarbonInterface;
use Domain\Analytics\Graph\DataSets\BarDataSet;
use Domain\Analytics\Graph\DataSets\LineDataSet;
use Domain\Analytics\Graph\Graph;
use Gitlab\ResultPager;
use GrahamCampbell\GitLab\GitLabManager;
use Http\Client\Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function show(Course $course, Task $task)
    {
        $project = $task->currentProjectForUser(auth()->user());
        return $this->showProject($course, $task, $project);
    }

    public function showProject(Course $course, Task $task, ?Project $project)
    {
        $myGroups = $course->groups()
            ->whereRelation('users', 'user_id', auth()->id())
            ->latest()
            ->pluck('name', 'id');
        if ($project != null)
            $project->append('validationStatus');
        $startDay    = $task->starts_at->format("j/n");
        $endDay      = $task->ends_at->format("j/n");
        $percent     = number_format(now()->diffInSeconds($task->starts_at) / $task->starts_at->diffInSeconds($task->ends_at) * 100, 2);
        $progress    = $percent > 100 ? 100 : $percent;
        $timeLeft    = $task->ends_at->isPast() ? '' : $task->ends_at->diffForHumans(now(), CarbonInterface::DIFF_ABSOLUTE, false, 2) . ' left';
        $myBuilds    = $project == null ? collect() : $project->dailyBuilds(false);
        $dailyBuilds = $task->dailyBuilds(true, false);

        $dailyBuildsGraph = new Graph($dailyBuilds->keys(),
            new BarDataSet("Total", $dailyBuilds->subtractByKey($myBuilds), "#6B7280"),
            new BarDataSet("You", $myBuilds, "#7BB026")
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
            'newProjectRoute' => $newProjectRoute,
            'availableGroups' => $myGroups,
            'breadcrumbs'     => [
                'Courses'     => route('courses.index'),
                $course->name => route('courses.show', $course->id),
                $task->name   => null
            ]
        ]);
    }

    public function doCreateProject(Course $course, Task $task, GitLabManager $gitLabManager)
    {
        $isSolo            = request('as', 'solo') == 'solo';
        $group             = $isSolo ? null : Group::findOrFail(request('as'));
        $users             = $isSolo ? Collection::wrap(auth()->user()) : $group->users;
        $membersInProgress = $task->progressStatus($users);

        abort_if($membersInProgress->count() > 0, 409, "The following members have already started a project: "
            . $membersInProgress->pluck('name')->map(function ($name)
            {
                return "<b>$name</b>";
            })->join(', ') . ".<br><br>"
            . "They will need to delete their project for the group to start the project.");

        if ($group != null)
            abort_unless(auth()->user()->can('canStartProject', $group), "You don't have access to this project.");

        $registeredGitLabUsers = $users->filter(function ($user) use ($gitLabManager)
        {
            $users = $gitLabManager->users()->all([
                'username' => $user->username
            ]);
            if (count($users) != 1)
                return false;
            $user->gitlab_id = $users[0]['id'];
            return true;
        });
        $missingGitLabUsers    = $users->pluck('name', 'username')->diffKeys($registeredGitLabUsers->pluck('name', 'username'));


        abort_if($missingGitLabUsers->count() > 0, 409, "The following members have not been registered at GitLab: "
            . $missingGitLabUsers->map(function ($name)
            {
                return "<b>$name</b>";
            })->join(', ') . ".<br><br>"
            . "They should log in to GitLab first.");

        $owner = $isSolo ? auth()->user() : $group;

        $project = $this->createProject($gitLabManager, $task, $owner->projectName, $owner);
        $project->addUsersToGitlab($registeredGitLabUsers->pluck('gitlab_id', 'name'), $warnings);
        $project->unprotectBranches();
        if (is_array($warnings) && count($warnings) > 0)
            session()->flash('warning', implode("<br>", $warnings));

        return "OK";
    }


    /**
     * @param GitLabManager $manager
     * @param Task $task
     * @param string $name
     * @param Group|User $owner
     * @return Project
     * @throws Exception
     */
    private function createProject(GitLabManager $manager, Task $task, string $name, $owner) : Project
    {
        $resultPager = new ResultPager($manager->connection());
        $projects    = collect($resultPager->fetchAll($manager->groups(), 'projects', [1167]));
        $project     = $projects->firstWhere('name', $name);
        if ($project == null)
            $project = $this->forkProject($manager, $name);

        $dbProject = $owner->projects()->updateOrCreate([
            'project_id' => $project['id'],
            'task_id'    => Task::first()->id,
            'repo_name'  => $project['name'],
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

        return $dbProject;
    }

    private function forkProject(GitLabManager $manager, $username)
    {
        return $manager->projects()->fork(2557, [
            'namespace' => 'webtech/assignment-1',
            'name'      => $username,
            'path'      => $username
        ]);
    }
}
