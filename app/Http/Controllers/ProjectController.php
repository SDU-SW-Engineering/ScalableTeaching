<?php

namespace App\Http\Controllers;

use App\Events\ProjectCreated;
use App\Listeners\GitLab\Project\RefreshMemberAccess;
use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Enums\PipelineStatusEnum;
use App\Models\Group;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\Task;
use App\ProjectStatus;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Gitlab\Exception\RuntimeException;
use GrahamCampbell\GitLab\GitLabManager;
use GraphQL\Client;
use GraphQL\SchemaObject\RepositoryTreeArgumentsObject;
use GraphQL\SchemaObject\RootProjectsArgumentsObject;
use GraphQL\SchemaObject\RootQueryObject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Str;
use Symfony\Component\HttpFoundation\StreamedResponse;
use function Pest\Laravel\get;

class ProjectController extends Controller
{
    /**
     * @param Project $project
     * @return Collection<int, array{status:PipelineStatusEnum,run_time:string,queued_for:string,ran:string,ran_date:string,sub_tasks:Collection<int,array{name:string,completed:bool}>,user_name:string}>
     */
    public function builds(Project $project) : Collection
    {
        return $project->pipelines()->with('subTasks')->latest()->get()->append('prettySubTasks')->map(fn (Pipeline $job) => [
            'status'     => $job->status,
            'run_time'   => CarbonInterval::seconds($job->duration)->forHumans(),
            'queued_for' => CarbonInterval::seconds($job->queue_duration)->forHumans(),
            'ran'        => $job->updated_at->diffForHumans(),
            'ran_date'   => $job->updated_at->toDateTimeString(),
            'sub_tasks'  => $job->pretty_sub_tasks,
            'user_name'  => $job->user_name,
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function reset(GitLabManager $gitLabManager, Project $project) : string
    {
        abort_unless($project->status == ProjectStatus::Active, 400);
        \DB::transaction(function () use ($gitLabManager, $project) {
            $found = true;
            try
            {
                $gitLabManager->projects()->show($project->project_id);
            } catch(RuntimeException $runtimeException)
            {
                $found = $runtimeException->getCode() != 404;
            }

            if ($found)
                $gitLabManager->projects()->remove($project->project_id);


            $project->delete();
        });

        return "OK";
    }

    public function migrate(Project $project, Group $group) : string
    {
        $activeUsers = $project->task->projectsForUsers($group->members)->reject(function (Project $currentProject) use ($project) {
            return $currentProject->id == $project->id;
        })->map(function (Project $project) {
            return $project->owners()->pluck('name');
        })->flatten();

        abort_if($activeUsers->count() > 0, 409, "The following members have already started a project: "
            . $activeUsers->join(", ") . '<br><br>They will need to delete their project for the group to start the project.');

        $project->ownable()->associate($group)->save();

        \App\Jobs\Project\RefreshMemberAccess::dispatch($project);

        return "ok";
    }

    public function refreshAccess(Project $project) : string
    {
        \App\Jobs\Project\RefreshMemberAccess::dispatch($project);

        return "ok";
    }

    public function download(Course $course, Task $task, Project $project, GitLabManager $gitLabManager) : StreamedResponse
    {
        $sha = $project->final_commit_sha;
        abort_if($sha == null, 404);

        return response()->streamDownload(function () use ($sha, $project, $gitLabManager) {
            echo $gitLabManager->repositories()->archive($project->project_id, [
                'sha' => $sha,
            ], 'zip');
        }, "$project->repo_name.zip");
    }

    /**
     * @throws \Exception
     */
    public function validateProject(Course $course, Task $task, Project $project) : RedirectResponse
    {
        if ($project->final_commit_sha == null)
            return redirect()->back()->withErrors('Can\'t validate this project as it isn\' finished yet');

        $files = $project->task->protectedFiles;
        $directories = $files->groupBy('directory');
        $errors = [];
        foreach ($directories as $directory => $files)
        {
            $rootObject = new RootQueryObject();
            $rootObject->selectProjects((new RootProjectsArgumentsObject())
                ->setIds(["gid://gitlab/Project/$project->project_id"])
                ->setFirst(1))
                ->selectNodes()
                ->selectRepository()
                ->selectTree((new RepositoryTreeArgumentsObject())->setPath(trim($directory, '/'))->setRef($project->final_commit_sha))
                ->selectBlobs()
                ->selectNodes()
                ->selectName()
                ->selectSha();
            $client = new Client('https://gitlab.sdu.dk/api/graphql', ["Authorization" => 'Bearer ' . getenv('GITLAB_ACCESS_TOKEN')]);
            $projects = $client->runQuery($rootObject->getQuery())->getResults()->data->projects->nodes; // @phpstan-ignore-line

            if (count($projects) == 0)
            {
                throw new \Exception("Project with id $project->id wasn't found.");
            }

            $repoFiles = collect($projects[0]->repository->tree->blobs->nodes); //@phpstan-ignore-line
            foreach ($files as $file)
            {
                $lookFor = $file->baseName;
                $found = $repoFiles->firstWhere('name', $lookFor);
                if ($found == null)
                {
                    $errors[] = "The file \"{$file->path}\" is missing.";
                    continue;
                }

                $shaValues = new Collection($file->sha_values);
                $shaIntact = $shaValues->contains($found->sha);
                if ( ! $shaIntact)
                {
                    $errors[] = "The file \"{$file->path}\" has been altered! Expected one of [{$shaValues->join(', ')}] but got $found->sha.";
                }
            }
        }

        $project->update([
            'validated_at'      => now(),
            'validation_errors' => $errors,
        ]);

        return redirect()->back();
    }
}
