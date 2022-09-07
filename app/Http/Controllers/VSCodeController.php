<?php

namespace App\Http\Controllers;

use App\Jobs\Project\DownloadProject;
use App\Models\Casts\SubTask;
use App\Models\Casts\SubTaskCollection;
use App\Models\Course;
use App\Models\GradeDelegation;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\ProjectStatus;
use Cache;
use Carbon\Carbon;
use Domain\Files\Directory;
use Domain\Files\File;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Storage;
use ZipArchive;

class VSCodeController extends Controller
{
    public function authenticate(Request $request) : string
    {
        $validated = Validator::make($request->all(), ['token' => 'required']);
        if($validated->fails())
            return "Token missing";
        Cache::remember('vs-code-auth:' . $request->get('token'), 180, fn() => auth()->id());

        return "Successfully logged in, you may now close this window.";
    }

    /**
     * @param Request $request
     * @return array<string,string>|Response
     */
    public function retrieveAuthentication(Request $request) : array|Response
    {
        $validated = Validator::make($request->all(), ['token' => 'required']);
        if($validated->fails())
            return response("Token missing", 400);
        $token = $request->get('token');
        if( ! Cache::has("vs-code-auth:$token"))
            return response(['type' => 'error', 'message' => 'Not found'], 404);

        $userId = Cache::get("vs-code-auth:$token");
        $user = User::find($userId);
        $userToken = $user->createToken("vs-code");
        Cache::forget("vs-code-auth:$token");

        return [
            'type'  => 'success',
            'token' => $userToken->plainTextToken,
            'name'  => $user->name,
        ];
    }

    /**
     * @return Collection<int,Course>
     */
    public function courses() : Collection
    {
        return auth()->user()->courses()->withCount('members')->get();
    }

    /**
     * @param Course $course
     * @param Task $task
     * @param Project $project
     * @return Collection<int, array{group: mixed, tasks: mixed}>
     */
    public function gradingScheme(Course $course, Task $task, Project $project) : Collection
    {
        $pointsGiven = $project->subTasks()->pluck('points', 'sub_task_id');
        $comments = $project->subTaskComments->groupBy('sub_task_id');

        return $task->sub_tasks->all()->groupBy('group')->map(fn($tasks, $group) => [
            'group' => $group,
            'tasks' => $tasks->map(fn(SubTask $task) => [
                ...$task->toArray(),
                'pointsAcquired'   => $pointsGiven->has($task->getId()) ? $pointsGiven->get($task->getId()) : null,
                'comments'         => $comments->has($task->getId()) ? $comments->get($task->getId()) : [],
            ]),
        ])->values();
    }

    /**
     * @param Course $course
     * @return Collection<int, array{id: mixed, name: string, projects: mixed}>
     */
    public function courseTasks(Course $course) : Collection
    {
        $tasks = $course->tasks()->with('projects')->get()->keyBy('id');
        $tasks->makeHidden('description');
        $tasks->makeHidden('markdown_description');

        $delegatedProjectIds = auth()->user()->gradeDelegations()->pluck('pseudonym', 'project_id');
        $delegatedProjects = Project::with(['task' => function(BelongsTo $query) {
            $query->select('id', 'name');
        }])->whereIn('task_id', $tasks->pluck('id'))
            ->whereIn('id', $delegatedProjectIds->flip())
            ->get()
            ->map(fn(Project $project) => [
                'repo_name' => $delegatedProjectIds[$project->id],
                'task_id'   => $project->task_id,
                'status'    => $project->status,
                'id'        => $project->id,
            ]);


        return $delegatedProjects->groupBy('task_id')
            ->map(fn($projects, $taskId) => ['id' => $taskId, 'name' => $tasks[$taskId]->name, 'projects' => $projects])
            ->values();
    }

    public function fileTree(Course $course, Task $task, Project $project) : Response|Directory
    {
        $download = $project->latestDownload();

        if($download === null || ! $download->isDownloaded)
            return response("This task is not available yet. If this persists the student has most likely not handed in within the deadline.", 404);

        $file = Storage::disk('local')->path($download->location);
        $zip = new ZipArchive();
        $zip->open($file, ZipArchive::RDONLY);
        $root = new Directory(".");
        for($i = 0; $i < $zip->numFiles; $i++)
        {
            $fileName = $zip->getNameIndex($i);
            $path = explode('/', $fileName);
            $currentDir = $root;
            for($j = 0; $j < count($path); $j++)
            {
                $file = $path[$j];
                if($j + 1 < count($path))
                {
                    $nextDirectory = $currentDir->getDirectory($file) ?? $currentDir->addDirectory(new Directory($file));
                    $currentDir = $nextDirectory;
                    continue;
                }
                if($file == "")
                    continue;
                $currentDir->addFile(new File($fileName));;
            }
        }

        return $root->nextDirectoryWithFiles();
    }

    /**
     * @param Course $course
     * @param Task $task
     * @param Project $project
     * @return array{file: string}|Response
     */
    public function file(Course $course, Task $task, Project $project) : array|Response
    {
        $file = \request('file');

        $download = $project->latestDownload();
        if($download == null || ! $download->isDownloaded)
            return response("This task is not available yet. Try again later.", 404);

        $fileOnDisk = Storage::disk('local')->path($download->location);
        $zip = new ZipArchive();
        $zip->open($fileOnDisk);
        $fp = $zip->getStream($file);
        $contents = null;
        while( ! feof($fp))
        {
            $contents .= fread($fp, 2);
        }
        fclose($fp);

        return [
            'file' => $contents,
        ];
    }

    /**
     * @throws \Exception
     */
    public function submitGrading(Course $course, Task $task, Project $project) : string|Response
    {
        $validator = Validator::make(\request()->all(), [
            'tasks'             => ['array', 'required'],
            'tasks.*.subtaskId' => ['required', 'distinct'],
            'tasks.*.points'    => ['nullable', 'numeric'],
            'tasks.*.comment'   => ['nullable', 'string'],
            'startedAt'         => ['required', 'date'],
            'endedAt'           => ['required', 'date', 'after:startedAt'],
        ]);

        if($validator->fails())
            return response("The submitted data is invalid, are you using the latest version of the extension?", 400);

        $userDelegation = $project->gradeDelegations()->firstWhere('user_id', auth()->id());
        abort_if($userDelegation == null, 403, "You can't grade this project.");
        $project->subTasks()->delete();
        $project->subTaskComments()->delete();

        $subTasks = [];
        $subTaskComments = [];

        (new Collection(request('tasks')))->each(function($task) use ($userDelegation, &$subTasks, &$subTaskComments) {
            $subTasks[] = [
                'sub_task_id' => $task['subtaskId'],
                'points'      => $task['points'] ?? 0,
                'source_type' => GradeDelegation::class,
                'source_id'   => $userDelegation->id,
            ];

            if($task['comment'] == null)
                return;

            $subTaskComments[] = [
                'sub_task_id' => $task['subtaskId'],
                'author_id'   => auth()->id(),
                'text'        => $task['comment'],
            ];
        });

        $project->subTasks()->createMany($subTasks);
        $project->subTaskComments()->createMany($subTaskComments);

        $startedAt = \request('startedAt') == null ? null : Carbon::parse(\request('startedAt'))->setTimezone(config('app.timezone'));
        $endedAt = \request('endedAt') == null ? null : Carbon::parse(\request('endedAt'))->setTimezone(config('app.timezone'));
        $project->setProjectStatusFor(ProjectStatus::Finished, GradeDelegation::class, $userDelegation->id, [
            'subtasks' => \request('tasks'),
        ], $startedAt, $endedAt);

        return "OK";
    }
}
