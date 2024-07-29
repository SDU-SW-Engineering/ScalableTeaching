<?php

namespace App\Modules\BuildTracking;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Project;
use App\Models\Task;
use Domain\Analytics\Graph\DataSets\BarDataSet;
use Domain\Analytics\Graph\Graph;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BuildTrackingController extends Controller
{
    public function builds(Course $course, Task $task) : VIew
    {
        $dailyBuilds = $task->dailyBuilds(true, true);
        $activeIndex = $dailyBuilds->keys()->search(\request('q'));
        $dailyBuildsGraph = new Graph($dailyBuilds->keys(), new BarDataSet("Builds", $dailyBuilds->values(), "#4F535B", $activeIndex === false ? null : $activeIndex));
        $buildQuery = $task->jobs();

        if(\request('q') != null)
            $buildQuery->whereRaw('date(pipelines.created_at) = ?', \request('q'));

        if(\request('status') != null)
            $buildQuery->where('pipelines.status', \request('status'));

        $buildQuery->latest('updated_at');
        $builds = $buildQuery->paginate(25)->withQueryString();

        return view('module-BuildTracking::Pages.builds', compact('course', 'task', 'dailyBuildsGraph', 'builds'));
    }

    public function browseGitlabPipeline(Course $course, Task $task, Project $project): RedirectResponse
    {
        $pipelineId = request()->query('pipeline_id');
        if ($pipelineId == null)
        {
            flash()->addError('Pipeline ID, can not be null.');

            return redirect()->back();
        }

        $gitLabManager = app(GitLabManager::class);
        $gitLabProject = $gitLabManager->projects()->show($project->gitlab_project_id);


        $gitLabRedirectUrl = $gitLabProject['web_url'] . '/pipelines/' . $pipelineId;

        return redirect($gitLabRedirectUrl);
    }
}
