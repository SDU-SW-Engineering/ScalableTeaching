<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function Ramsey\Uuid\v1;

class CourseController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->courses->map(function($course) {

            $tasks = $course->tasks->map(function(Task $task) {
                $project = $task->currentProjectForUser(auth()->user());

                return [
                    'task'    => $task,
                    'project' => $project,
                    'status'  => $project?->status,
                ];
            });

            $deadline = $tasks->sort(function($a, $b) {
                $startsAtA = Carbon::parse($a['task']->starts_at);
                $endsAtA = Carbon::parse($a['task']->ends_at);
                $startsAtB = Carbon::parse($b['task']->starts_at);
                $endsAtB = Carbon::parse($b['task']->ends_at);

                if(now()->between($startsAtA, $endsAtA))
                    return -1;
                if(now()->between($startsAtB, $endsAtB))
                    return 1;

                if($endsAtA->isPast() || $endsAtB->isPast())
                    return 1;

                return now()->diffInSeconds($endsAtA) > now()->diffInSeconds($endsAtB) ? 1 : -1;
            })->first();

            return [
                'id'            => $course->id,
                'name'          => $course->name,
                'taskCount'     => $tasks->count(),
                'completed'     => $tasks->where('status', 'finished')->count(),
                'next_deadline' => $deadline != null ? $deadline['task']->ends_at : null,
            ];
        });

        return view('courses.index', [
            'courses'     => $courses,
            'bg'          => 'bg-gray-100 dark:bg-gray-700',
            'breadcrumbs' => [
                'Courses' => null,
            ],
        ]);
    }

    public function create()
    {
        return view('courses.create', [
            'breadcrumbs' => [
                'Courses' => route('courses.index'),
                'Create'  => null,
            ],
        ]);
    }

    public function store(Request $request, GitLabManager $manager)
    {
        $validated = $request->validate([
            'course-name' => 'required|max:255',
        ]);

        $snakeName = Str::snake($validated['course-name']);

        $currentGroup = $manager->groups()->subgroups(getenv('GITLAB_GROUP'), ['search' => $snakeName]);
        if (count($currentGroup) > 0)
            return redirect()->back()->withErrors(['course-name' => 'A course with that name already exists in GitLab.'])->withInput();

        $gitlabGroup = [
            'name' => $validated['course-name'],
            'path' => $snakeName,
            'visibility' => 'private',
            'parent_id' => getenv('GITLAB_GROUP')
        ];

        $response = $manager->getHttpClient()->post('api/v4/groups', ['Content-type' => 'application/json'], json_encode($gitlabGroup));
        $groupResponse = json_decode($response->getBody()->getContents(), true);
        if($response->getStatusCode() != 201)
            return back()
                ->withErrors(['course-name' => 'Couldn\'t create associated GitLab group, try again later.'])
                ->withInput();

        $course = Course::create([
            'name'            => $validated['course-name'],
            'gitlab_group_id' => $groupResponse['id'],
        ]);

        $course->members()->attach(auth()->id(), ['role' => 'teacher']);

        return redirect()->route("courses.index");
    }

    public function show(Course $course)
    {
        $tasks = $course->tasks()->whereNull('track_id')->where('is_visible', true)->get()->map(fn(Task $task) => [
            'details' => $task,
            'project' => $task->currentProjectForUser(auth()->user()),
        ]);

        $inProgress = $tasks->filter(function($task) {
            return now()->isBetween($task['details']->starts_at, $task['details']->ends_at);
        });
        $past = $tasks->filter(function($task) {
            return now()->isAfter($task['details']->ends_at);
        });
        $upcoming = $tasks->filter(function($task) {
            return now()->isBefore($task['details']->starts_at);
        });

        $taskCount = $tasks->count();
        $failed = $tasks->filter(function($task) {
            if($task['project'] == null && $task['details']->ends_at->isPast())
                return true;

            return $task['project']?->status == 'overdue';
        })->count();
        $approved = $tasks->filter(fn($task) => $task['project']?->status == 'finished')->count();

        return view('courses.show', [
            'course'             => $course,
            'inProgress'         => $inProgress,
            'upcoming'           => $upcoming,
            'past'               => $past,
            'bg'                 => 'bg-gray-50 dark:bg-gray-600',
            'taskCount'          => $taskCount,
            'remainingTaskCount' => $taskCount - $failed - $approved,
            'failedCount'        => $failed,
            'approvedCount'      => $approved,
            'breadcrumbs'        => [
                'Courses'     => route('courses.index'),
                $course->name => null,
            ],
            'tasks'              => $tasks,
        ]);
    }

    private function retrieveCourses(bool $withDescription = false, bool $finishedOnly = true)
    {
        $statuses = \DB::table('projects')
            ->select('task_id', 'status')
            ->where('ownable_id', auth()->id())
            ->whereNull('deleted_at')
            ->groupBy('task_id', 'status');
        if($finishedOnly)
            $statuses->where('status', 'finished');

        $select = collect(['projects.status', 'tasks.starts_at', 'tasks.ends_at', 'tasks.course_id', 'tasks.id']);
        if($withDescription)
        {
            $select->add('tasks.short_description');
            $select->add('tasks.name');
        }

        return Course::with([
            'tasks' => function(HasMany $query) use ($select, $statuses) {
                return $query->select($select->toArray())
                    ->leftJoinSub($statuses, 'projects', 'tasks.id', '=', 'projects.task_id');
            },
        ]);
    }

    public function showManage(Course $course)
    {
        return view('courses.manage.index', [
            'course'      => $course,
            'breadcrumbs' => [
                'Courses'     => route('courses.index'),
                $course->name => null,
            ],
        ]);
    }

    public function addTeacher(Course $course)
    {
        $validated = \Validator::make(\request()->all(), [
            'teacher' => ['required', 'exists:users,id'],
        ])->validateWithBag('teachers');

        $user = User::find($validated['teacher']);
        $course->teachers()->syncWithoutDetaching([$user->id => ['role' => 'teacher']]);

        return redirect()->back();
    }

    public function removeTeacher(Course $course, User $teacher)
    {
        if($teacher->id == auth()->id())
            return redirect()->back()->withErrors('You can\'t remove yourself.', 'teachers');

        $course->teachers()->detach($teacher);

        return redirect()->back();
    }

    public function showEnroll(Course $course)
    {
        if($course->enroll_token != request('token'))
            return redirect()->route('home')->withError('Invalid course token');

        if($course->users()->where(['user_id' => auth()->id()])->exists())
            return redirect()->route('courses.show', [$course->id]);

        if(!request()->has('confirm'))
            return view('courses.enroll-dialog', compact('course'));

        $course->users()->attach(auth()->id(), ['role' => 'student']);

        return redirect()->route('courses.show', [$course->id]);
    }
}
