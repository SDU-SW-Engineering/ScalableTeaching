<?php

namespace App\Http\Controllers;

use Gitlab\Client;
use GrahamCampbell\GitLab\Facades\GitLab;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(GitLabManager $gitLabManager)
    {
        return view('home');

        $username = explode('@', auth()->user()->getMail())[0];

        $gitlabUser = collect($gitLabManager->users()->all([
            'username' => $username
        ]));

        if ($gitlabUser->isEmpty())
            return

                //$gitLabManager->groups()->projects(1166));
                $project = $gitLabManager->projects()->fork(2557, [
                    'namespace' => 'webtech/assignment-1',
                    'name'      => $username,
                    'path'      => $username
                ]);

        $gitLabManager->projects()->addMember($project['id'], [
            'user_id' => $username
        ]);
        dd($gitLabManager->groups());
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

    /**
     * @return int Project id
     */
    private function createProject(GitLabManager $manager, $username) : int
    {
        $project = collect($manager->groups()->projects(1167))->firstWhere('name', $username);
        if ($project == null)
            $project = $this->forkProject($manager, $username);
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
