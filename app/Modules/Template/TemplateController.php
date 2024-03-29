<?php

namespace App\Modules\Template;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\Project;
use App\Models\Task;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TemplateController extends BaseController
{
    public function pushes(Course $course, Task $task) : View
    {
        $pushes = $task->pushes()->with(['project.ownable'])->latest()->paginate(50);

        return view('module-Template::Pages.pushes', compact('pushes'));
    }

    public function browseGitlabAtCommit(Course $course, Task $task, Project $project): RedirectResponse
    {
        $commitSha = request()->query('commit_sha');
        if ($commitSha == null)
        {
            flash()->addError('Commit SHA, can not be null.');

            return redirect()->back();
        }

        $gitLabManager = app(GitLabManager::class);
        $gitLabProject = $gitLabManager->projects()->show($project->gitlab_project_id);

        $gitLabRedirectUrl = $gitLabProject['web_url'] . '/tree/' . $commitSha;

        return redirect($gitLabRedirectUrl);
    }
}

