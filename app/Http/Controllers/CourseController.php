<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all()->map(function ($course)
        {
            $tasks = $course->tasks->each(function (Task $task)
            {
                $project      = $task->currentProjectForUser(auth()->user());
                $task->status = $project == null ? null : $project->status;
            });

            $deadline = $tasks->sort(function ($a, $b)
            {
                $startsAtA = Carbon::parse($a->starts_at);
                $endsAtA   = Carbon::parse($a->ends_at);
                $startsAtB = Carbon::parse($b->starts_at);
                $endsAtB   = Carbon::parse($b->ends_at);

                if (now()->between($startsAtA, $endsAtA))
                    return -1;
                if (now()->between($startsAtB, $endsAtB))
                    return 1;

                if ($endsAtA->isPast() || $endsAtB->isPast())
                    return 1;

                return now()->diffInSeconds($endsAtA) > now()->diffInSeconds($endsAtB) ? 1 : -1;
            })->first();

            return [
                'id'            => $course->id,
                'name'          => $course->name,
                'taskCount'     => $tasks->count(),
                'completed'     => $tasks->where('status', 'finished')->count(),
                'next_deadline' => $deadline == null ? null : $deadline->ends_at
            ];
        });

        return view('courses.index', [
            'courses'     => $courses,
            'bg'          => 'bg-gray-100 dark:bg-gray-700',
            'breadcrumbs' => [
                'Courses' => null
            ]
        ]);
    }

    public function show(Course $course)
    {
        $tasks = $course->tasks->each(function (Task $task)
        {
            $task->project = $task->currentProjectForUser(auth()->user());
        });

        $inProgress = $tasks->filter(function ($task)
        {
            return now()->isBetween($task->starts_at, $task->ends_at);
        });
        $past       = $tasks->filter(function ($task)
        {
            return now()->isAfter($task->ends_at);
        });
        $upcoming   = $tasks->filter(function ($task)
        {
            return now()->isBefore($task->starts_at);
        });

        $taskCount = $tasks->count();
        $failed    = $tasks->filter(function ($task)
        {
            if ($task->project == null) // todo: php8 ?->
                return false;
            return $task->project->status == 'overdue';
        })->count();
        $approved  = $tasks->filter(function ($task)
        {
            if ($task->project == null) // todo: php8 ?->
                return false;
            return $task->project->status == 'finished';
        })->count();

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
                $course->name => null
            ]
        ]);
    }

    private function retrieveCourses(bool $withDescription = false, bool $finishedOnly = true)
    {
        $statuses = \DB::table('projects')
            ->select('task_id', 'status')
            ->where('ownable_id', auth()->id())
            ->whereNull('deleted_at')
            ->groupBy('task_id', 'status');
        if ($finishedOnly)
            $statuses->where('status', 'finished');

        $select = collect(['projects.status', 'tasks.starts_at', 'tasks.ends_at', 'tasks.course_id', 'tasks.id']);
        if ($withDescription)
        {
            $select->add('tasks.short_description');
            $select->add('tasks.name');
        }
        return Course::with([
            'tasks' => function (HasMany $query) use ($select, $statuses)
            {
                return $query->select($select->toArray())
                    ->leftJoinSub($statuses, 'projects', 'tasks.id', '=', 'projects.task_id');
            }
        ]);
    }

    public function showManage(Course $course)
    {
        return view('courses.manage.index', [
            'course'      => $course,
            'breadcrumbs' => [
                'Courses'     => route('courses.index'),
                $course->name => null
            ]
        ]);
    }

    public function addTeacher(Course $course)
    {
        $validated = \Validator::make(\request()->all(), [
            'teacher' => ['required', 'exists:users,id']
        ])->validateWithBag('teachers');

        $user = User::find($validated['teacher']);
        $course->teachers()->syncWithoutDetaching([$user->id => ['role' => 'teacher']]);

        return redirect()->back();
    }

    public function removeTeacher(Course $course, User $teacher)
    {
        if ($teacher->id == auth()->id())
            return redirect()->back()->withErrors('You can\'t remove yourself.', 'teachers');

        $course->teachers()->detach($teacher);

        return redirect()->back();
    }

    public function showEnroll(Course $course)
    {
        return view('courses.enroll-dialog');
    }
}
