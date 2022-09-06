<?php

namespace App\Http\Controllers;

use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\TaskTypeEnum;
use App\Models\Grade;
use App\Models\GradeDelegation;
use App\Models\Group;
use App\Models\Project;
use App\Models\ProjectSubTaskComment;
use App\Models\Task;
use App\Models\User;
use App\ProjectStatus;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Domain\Analytics\Graph\DataSets\BarDataSet;
use Domain\Analytics\Graph\DataSets\LineDataSet;
use Domain\Analytics\Graph\Graph;
use Domain\GitLab\CIReader;
use Domain\GitLab\CITask;
use Gitlab\Exception\RuntimeException;
use Gitlab\ResultPager;
use GrahamCampbell\GitLab\GitLabManager;
use GraphQL\SchemaObject\RootQueryObject;
use Http\Client\Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function show(Course $course, Task $task): View
    {
        abort_if( ! $task->is_visible && auth()->user()->cannot('manage', $course), 401);
        $project = $task->currentProjectForUser(auth()->user());

        return $this->showProject($course, $task, $project);
    }

    public function showProject(Course $course, Task $task, ?Project $project): View
    {
        $myGroups = $course->groups()
            ->whereRelation('members', 'user_id', auth()->id())
            ->latest()
            ->pluck('name', 'id');
        $startDay = $task->starts_at->format("j/n");
        $endDay = $task->ends_at->format("j/n");
        $percent = number_format(now()->diffInSeconds($task->starts_at) / $task->starts_at->diffInSeconds($task->ends_at) * 100, 2);
        $progress = min($percent, 100);
        $timeLeft = $task->ends_at->isPast() ? '' : $task->ends_at->diffForHumans(now(), CarbonInterface::DIFF_ABSOLUTE, false, 2) . ' left';
        $myBuilds = $project == null ? new Collection() : $project->dailyBuilds();
        $dailyBuilds = $task->dailyBuilds(true);

        $project?->append('is_missed');
        $completedSubTasks = $project?->subTasks->keyBy('sub_task_id');
        $completedSubTaskComments = $project?->subTaskComments()->with('author')->get()->map(fn(ProjectSubTaskComment $comment) => [
            'sub_task_id' => $comment->sub_task_id,
            'author'      => $comment->author->name,
            'text'        => $comment->text,
        ])->groupBy('sub_task_id');
        $subTasks = $task->sub_tasks->all()->groupBy('group')->map(fn(\Illuminate\Support\Collection $subTasks, $group) => [
            'group' => $group,
            'tasks' => $subTasks->map(fn(SubTask $subTask) => [
                'name'           => $subTask->getDisplayName(),
                'pointsAcquired' => $completedSubTasks?->has($subTask->getId()) ? $completedSubTasks->get($subTask->getId())->points : null,
                'comments'       => $completedSubTaskComments?->has($subTask->getId()) ? $completedSubTaskComments->get($subTask->getId()) : [],
                'points'         => $subTask->getPoints(),
                'required'       => $subTask->isRequired() ?? true,
                'group'          => $subTask->getGroup(),
            ]),
        ])->values();

        $survey = $task->survey()?->load(['fields' => function(HasMany $query) {
            $query->where('type', '!=', 'environment');
        }, 'fields.items']);

        $dailyBuildsGraph = new Graph(
            $dailyBuilds->keys(),
            new BarDataSet("Total", $dailyBuilds->subtractByKey($myBuilds), "#6B7280"),
            new BarDataSet("You", $myBuilds->values(), "#7BB026")
        );

        $gradeDelegations = $project?->status == ProjectStatus::Finished ? $project->gradeDelegations()->with('user')->get()->map(fn(GradeDelegation $gradeDelegation) => [
            'by'         => $gradeDelegation->user->name,
            'identifier' => $gradeDelegation->pseudonym,
        ]) : null;

        $newProjectRoute = route('courses.tasks.createProject', [$course->id, $task->id]);

        return view('tasks.show', [
            'course'          => $course,
            'task'            => $task->setHidden(['markdown_description']),
            'bg'              => 'bg-gray-50 dark:bg-gray-600',
            'project'         => $project,
            'subTasks'        => in_array($task->correction_type, [CorrectionType::NumberOfTasks, CorrectionType::PointsRequired, CorrectionType::AllTasks, CorrectionType::RequiredTasks, CorrectionType::Manual])
                ? ['list' => $subTasks, 'gradeDelegations' => $gradeDelegations]
                : null,
            'progress'        => [
                'startDay' => $startDay,
                'endDay'   => $endDay,
                'percent'  => $progress,
                'timeLeft' => $timeLeft,
                'ended'    => $task->ends_at->isPast(),
            ],
            'pushes'          => $project?->pushes()
                    ->where('created_at', '<=', $task->ends_at)
                    ->pluck('created_at') ?? [],
            'track'           => $task->track,
            'builds'          => $dailyBuilds,
            'myBuilds'        => $myBuilds,
            'buildGraph'      => $dailyBuildsGraph,
            'newProjectRoute' => $newProjectRoute,
            'availableGroups' => $myGroups,
            'survey'          => [
                'details'   => $survey,
                'submitted' => $project != null && ($survey?->isAnswered(auth()->user(), $task) ?? false),
                'deadline'  => [
                    'forHumans' => $survey?->pivot->deadline->diffForHumans(),
                    'date'      => $survey?->pivot->deadline->toDateTimeString(),
                ],
                'can'       => [
                    'view'   => $survey == null ? false : auth()->user()->can('view', [$survey, $project]),
                    'answer' => $survey == null ? false : auth()->user()->can('answer', [$survey, $project]),
                ],
            ],
            'breadcrumbs'     => [
                'Courses'     => route('courses.index'),
                $course->name => route('courses.show', $course->id),
                $task->name   => null,
            ],
        ]);
    }

    public function doCreateProject(Course $course, Task $task, GitLabManager $gitLabManager): string
    {
        $isSolo = request('as', 'solo') == 'solo';
        $group = $isSolo ? null : Group::findOrFail(request('as'));

        abort_if( ! $isSolo && ! auth()->user()->can('canStartProject', $group), 401, "You don't have access to this project.");
        abort_if( ! $task->canStart($isSolo ? auth()->user() : $group, $message), 410, $message);

        $owner = $isSolo ? auth()->user() : $group;
        $this->createProject($gitLabManager, $task, $owner->projectName, $owner);

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
    private function createProject(GitLabManager $manager, Task $task, string $name, $owner): Project
    {
        $resultPager = new ResultPager($manager->connection());
        $projects = collect($resultPager->fetchAll($manager->groups(), 'projects', [$task->gitlab_group_id]));
        $project = $projects->firstWhere('name', $name);
        if($project == null)
            $project = $this->forkProject($manager, $name, $task->source_project_id, $task->gitlab_group_id);

        $dbProject = $owner->projects()->updateOrCreate([
            'project_id' => $project['id'],
            'task_id'    => $task->id,
            'repo_name'  => $project['name'],
        ]);

        return $dbProject;
    }

    /**
     * @param GitLabManager $manager
     * @param string $username
     * @param int $sourceProjectId
     * @param int $groupId
     * @return array<string,string>
     * @throws Exception
     */
    private function forkProject(GitLabManager $manager, string $username, int $sourceProjectId, int $groupId): array
    {
        $params = [
            'name'                   => $username,
            'path'                   => $username,
            'namespace_id'           => $groupId,
            'shared_runners_enabled' => false,
        ];

        $id = rawurlencode((string)$sourceProjectId);
        $response = $manager->getHttpClient()->post("api/v4/projects/$id/fork", ['Content-type' => 'application/json'], json_encode($params));

        return json_decode($response->getBody()->getContents(), true);
    }

    public function showCreate(Course $course): View
    {
        $breadcrumbs = [
            'Courses'     => route('courses.index'),
            $course->name => null,
        ];

        return view('courses.manage.new-task', compact('course', 'breadcrumbs'));
    }

    public function edit(Course $course, Task $task): View
    {
        $breadcrumbs = [
            'Courses'     => route('courses.index'),
            $course->name => null,
        ];

        return view('courses.manage.editTask', compact('course', 'task', 'breadcrumbs'));
    }

    /**
     * @throws \Throwable
     */
    public function store(Course $course, GitLabManager $manager): array
    {
        $validated = request()->validateWithBag('new', [
            'name'        => 'required',
            'type' => 'required',
            'repo-id'  => ['required_if:type,repo', 'numeric', 'nullable']
        ]);

        /*try
        {
            $manager->projects()->show($validated['project-id']);
        } catch(RuntimeException $runtimeException)
        {
            if($runtimeException->getCode() == 404)
                return back()
                    ->withErrors(['project-id' => 'The GitLab project either doesn\'t exist or the Scalable Teaching user is not added to it.'], 'new')
                    ->withInput();
        }*/

        $snakeName = Str::snake($validated['name']);
        $params = [
            'name'                      => $validated['name'],
            'path'                      => $snakeName,
            //'description'               => $validated['description'],
            'visibility'                => 'private',
            //'parent_id'                 => $course->gitlab_group_id,
            'default_branch_protection' => 0,
            'lfs_enabled'               => false,
            'auto_devops_enabled'       => false,
            'request_access_enabled'    => false,
        ];
        /*$currentGroup = $manager->groups()->subgroups($course->gitlab_group_id, ['search' => $snakeName]);
        if(count($currentGroup) == 0)
        {
            $response = $manager->getHttpClient()->post('api/v4/groups', ['Content-type' => 'application/json'], json_encode($params));
            $groupResponse = json_decode($response->getBody()->getContents(), true);
            if($response->getStatusCode() != 201)
                return back()
                    ->withErrors(['project-id' => 'Couldn\'t create the project. Refrain from using symbols or foreign characters in the name.'], 'new')
                    ->withInput();
        } else
            $groupResponse = $currentGroup[0];*/


        /** @var Task $task */
        $task = $course->tasks()->create([
            //'source_project_id' => $validated['project-id'],
            'name'              => $validated['name'],
            //'gitlab_group_id'   => null//$groupResponse['id'],
        ]);

       /** try
        {
            $task->reloadDescriptionFromRepo();
        } catch(\Exception $ignored)
        {
        }*/

        return [
            'id' => $task->id,
            'route' => route('courses.tasks.admin.index', [$course->id, $task->id])
        ];
    }

    public function update(Course $course, Task $task): RedirectResponse
    {
        $validated = request()->validateWithBag('task', [
            'name'        => 'required',
            'description' => 'required',
            'from'        => ['required', 'date', 'before:to'],
            'to'          => ['required', 'date', 'after:from'],
            'start-time'  => ['required', 'date_format:H:i'],
            'end-time'    => ['required', 'date_format:H:i'],
        ]);

        $task->update([
            'name'              => $validated['name'],
            'short_description' => $validated['description'],
            'starts_at'         => Carbon::parse($validated['from'] . " " . $validated['start-time']),
            'ends_at'           => Carbon::parse($validated['to'] . " " . $validated['end-time']),
        ]);

        return redirect()->back()->with('success-task', 'The changes were saved.');
    }

    public function toggleVisibility(Course $course, Task $task): RedirectResponse
    {
        $task->is_visible = ! $task->is_visible;
        $task->save();

        return redirect()->back()->with('success-task', 'The visibility was updated.');
    }

    public function refreshReadme(Course $course, Task $task): RedirectResponse
    {
        try
        {
            $task->reloadDescriptionFromRepo();
        } catch(\Exception $exception)
        {
        }

        return redirect()->back()->with('success-task', 'The readme was updated.');
    }

    public function subtasks(Course $course, Task $task): View|RedirectResponse
    {
        $breadcrumbs = [
            'Courses'     => route('courses.index'),
            $course->name => null,
        ];

        $ciFile = $task->ciFile();
        if($ciFile == null)
            return redirect()->back()->withErrors('Source project doesn\'t contain the .gitlab-ci.yml file.', 'task');
        $tasks = collect((new CIReader($ciFile))->tasks())->map(fn(CITask $task) => [
            'stage'      => $task->getStage(),
            'name'       => $task->getName(),
            'id'         => null,
            'alias'      => '',
            'points'     => 0,
            'isRequired' => false,
            'isSelected' => false,
        ])->toArray();

        /** @var SubTask $subTask */
        foreach($task->sub_tasks->all() as $subTask)
        {
            $found = collect($tasks)->search(fn($t) => $t['name'] == $subTask->getName() || $t['id'] == $subTask->getId());
            if($found === false)
                continue;
            $tasks[$found]['name'] = $subTask->getName();
            $tasks[$found]['alias'] = $subTask->getAlias();
            $tasks[$found]['id'] = $subTask->getId();
            $tasks[$found]['points'] = $subTask->getPoints();
            $tasks[$found]['isRequired'] = $subTask->isRequired();
            $tasks[$found]['isSelected'] = true;
        }

        return view('courses.manage.taskSubtasks', compact('course', 'task', 'breadcrumbs', 'tasks'));
    }

    public function updateSubtasks(Course $course, Task $task): string
    {
        $tasks = new Collection(request('tasks'));
        $correctionType = CorrectionType::from(request('correctionType'));

        $selected = $tasks->filter(fn($task) => $task['isSelected']);
        $currentSubTasks = $task->sub_tasks;
        $removeIds = $task->sub_tasks->all()->map(fn(SubTask $subTask) => $subTask->getId())->diff($selected->pluck('id'));
        $currentSubTasks->remove($removeIds->toArray());
        $selected->each(function($task) use ($currentSubTasks) {
            $subTask = (new SubTask($task['name'], $task['alias'] == '' ? null : $task['alias']))
                ->setPoints($task['points'])
                ->setIsRequired($task['required']);
            if($task['id'] == null)
                $currentSubTasks->add($subTask);
            else
                $currentSubTasks->update($task['id'], $subTask);

        });
        $task->correction_type = $correctionType;
        $task->correction_points_required = request('requiredPoints');
        $task->correction_tasks_required = request('requiredTasks');
        $task->save();

        return "OK";
    }

    public function markComplete(Course $course, Task $task): string | Response
    {
        if($task->correction_type != CorrectionType::Self)
            return response('Bad request', 400);
        if(Grade::where(['task_id' => $task->id, 'user_id' => auth()->id()])->exists())
            return response('Bad request', 400);

        auth()->user()->grades()->create([
            'task_id'     => $task->id,
            'source_id'   => auth()->id(),
            'source_type' => User::class,
        ]);

        return "OK";
    }
}
