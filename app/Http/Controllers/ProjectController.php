<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\JobStatus;
use App\Models\Project;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Gitlab\Exception\RuntimeException;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function builds(Project $project)
    {
        return $project->jobStatuses()->latest()->get()->makeHidden(['history', 'log'])->map(function (JobStatus $job)
        {
            $job->run_time   = CarbonInterval::seconds($job->duration)->forHumans();
            $job->queued_for = CarbonInterval::seconds($job->queue_duration)->forHumans();
            $job->ran        = $job->updated_at->diffForHumans();
            $job->ran_date   = $job->updated_at->toDateTimeString();
            return $job;
        });
    }

    /**
     * @throws \Throwable
     */
    public function reset(GitLabManager $gitLabManager, Project $project)
    {
        abort_unless($project->status == 'active', 400);
        \DB::transaction(function () use ($gitLabManager, $project)
        {
            $found = true;
            try
            {
                $gitLabManager->projects()->show($project->project_id);
            }
            catch (RuntimeException $runtimeException)
            {
                $found = $runtimeException->getCode() != 404;
            }

            if ($found)
                $gitLabManager->projects()->remove($project->project_id);

            $project->delete();
        });

        return "OK";
    }

    public function migrate(Project $project, Group $group)
    {
        $activeUsers = $project->task->projectsForUsers($group->users)->reject(function (Project $currentProject) use ($project)
        {
            return $currentProject->id == $project->id;
        })->map(function (Project $project)
        {
            return $project->owners()->pluck('name');
        })->flatten();

        abort_if($activeUsers->count() > 0, 409, "The following members have already started a project: "
            . $activeUsers->join(", ") . '<br><br>They will need to delete their project for the group to start the project.');

        $project->ownable()->associate($group)->save();
        $project->refreshGitlabAccess();
        return "ok";
    }

    public function refreshAccess(Project $project)
    {
        $project->refreshGitlabAccess();
        return "ok";
    }
}
