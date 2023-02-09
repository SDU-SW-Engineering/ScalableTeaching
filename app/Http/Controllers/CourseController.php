<?php

namespace App\Http\Controllers;

use App\Jobs\Course\AddMemberToCourseGroup;
use App\Models\Course;
use App\Models\Enums\TaskTypeEnum;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function Ramsey\Uuid\v1;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
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

    public function create(): View
    {
        return view('courses.create', [
            'breadcrumbs' => [
                'Courses' => route('courses.index'),
                'Create'  => null,
            ],
        ]);
    }

    public function store(Request $request, GitLabManager $manager): RedirectResponse
    {
        $validated = $request->validate([
            'course-name' => 'required|max:255',
        ]);

        $pathName = Str::slug($validated['course-name']);
        $currentGroup = $manager->groups()->subgroups(getenv('GITLAB_GROUP'), ['search' => $pathName]);
        if(count($currentGroup) > 0)
            return redirect()->back()->withErrors(['course-name' => 'A course with that name already exists in GitLab.'])->withInput();

        $gitlabGroup = [
            'name'       => $validated['course-name'],
            'path'       => $pathName,
            'visibility' => 'private',
            'parent_id'  => getenv('GITLAB_GROUP'),
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

    public function show(Course $course): View
    {
        $tasksQuery = $course->tasks()->whereNull('track_id');
        if(auth()->user()->cannot('viewInvisible', $course))
            $tasksQuery->where('is_visible', true);

        $tasks = $tasksQuery->orderBy('order')->get()->map(fn(Task $task) => [
            'details' => $task,
            'project' => $task->currentProjectForUser(auth()->user()),
        ]);

        $exerciseGroups = $tasks->filter(fn($task) => $task['details']->type == TaskTypeEnum::Exercise)
            ->groupBy(fn($task) => $task['details']->grouped_by);
        $assignments = $tasks->filter(fn($task) => $task['details']->type == TaskTypeEnum::Assignment);

        $taskCount = $course->tasks()->count();

        return view('courses.show', [
            'course'         => $course,
            'bg'             => 'bg-gray-50 dark:bg-gray-600',
            'taskCount'      => $taskCount,
            'breadcrumbs'    => [
                'Courses'     => route('courses.index'),
                $course->name => null,
            ],
            'exerciseGroups' => $exerciseGroups,
            'assignments'    => $assignments,
        ]);
    }

    public function addTeacher(Course $course): RedirectResponse
    {
        $validated = \Validator::make(\request()->all(), [
            'teacher' => ['required', 'exists:users,id'],
        ])->validateWithBag('teachers');

        $user = User::find($validated['teacher']);
        $course->teachers()->syncWithoutDetaching([$user->id => ['role' => 'teacher']]);

        return redirect()->back();
    }

    public function removeTeacher(Course $course, User $teacher): RedirectResponse
    {
        if($teacher->id == auth()->id())
            return redirect()->back()->withErrors('You can\'t remove yourself.', 'teachers');

        $course->teachers()->detach($teacher);

        return redirect()->back();
    }

    public function showEnroll(Course $course): RedirectResponse|View
    {
        if($course->enroll_token != request('token'))
            return redirect()->route('home')->withError('Invalid course token');

        if($course->members()->where(['user_id' => auth()->id()])->exists())
            return redirect()->route('courses.show', [$course->id]);

        if( ! request()->has('confirm'))
            return view('courses.enroll-dialog', compact('course'));

        $course->members()->attach(auth()->id(), ['role' => 'student']);
        if($course->gitlab_task_group_id != null)
            AddMemberToCourseGroup::dispatch(auth()->user()->gitlab_id, $course->gitlab_task_group_id, 20);

        return redirect()->route('courses.show', [$course->id]);
    }
}
