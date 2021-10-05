<?php

namespace App\Http\Controllers;

use App\Models\JobStatus;
use Carbon\Carbon;
use Gitlab\Client;
use GrahamCampbell\GitLab\Facades\GitLab;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(GitLabManager $gitLabManager)
    {
        return view('home');
    }

    public function start(GitLabManager $gitLabManager)
    {
        $username = explode('@', auth()->user()->getMail())[0];

        $gitlabUser = collect($gitLabManager->users()->all([
            'username' => $username
        ]));

        if ($gitlabUser->isEmpty())
            return redirect()->home()->with('missing-gitlab-user', true);


        $projectId    = $this->createProject($gitLabManager, $username);
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

        if ( ! $added)
            return redirect()->home()->with('error', 'Unable to add you to the repository, try again later.');

        return redirect()->home()->with('success', $projectId);
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

    /**
     * @return int Project id
     */
    private function createProject(GitLabManager $manager, $username) : int
    {
        $project = collect($manager->groups()->projects(1167))->firstWhere('name', $username);
        if ($project == null)
            $project = $this->forkProject($manager, $username);

        $currentHooks = collect($manager->projects()->hooks($project['id']));
        if ($currentHooks->isEmpty())
        {
            $manager->projects()->addHook($project['id'], 'https://webtech.sdu.dk/api/reporter', [
                'job_events' => true,
                'token'      => md5(strtolower($project['name']) . "webtechf21"),
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
}
