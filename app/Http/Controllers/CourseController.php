<?php

namespace App\Http\Controllers;

use App\Models\Course;
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
        $courses = $this->retrieveCourses()->get()->map(function ($course)
        {

            $deadline = $course->tasks->sort(function ($a, $b)
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
                'taskCount'     => $course->tasks->count(),
                'completed'     => $course->tasks->where('status', 'finished')->count(),
                'next_deadline' => $deadline == null ? null : $deadline->ends_at
            ];
        });

        return view('courses.index', [
            'courses' => $courses,
            'bg'      => 'bg-gray-100 dark:bg-gray-700'
        ]);
    }

    public function show(Course $course)
    {
        $course = $this->retrieveCourses(true, false)->findOrFail($course->id);

        $inProgress = $course->tasks->filter(function ($task)
        {
            return now()->isBetween($task->starts_at, $task->ends_at);
        });
        $past       = $course->tasks->filter(function ($task)
        {
            return now()->isAfter($task->ends_at);
        });
        $upcoming   = $course->tasks->filter(function ($task)
        {
            return now()->isBefore($task->starts_at);
        });

        $taskCount = $course->tasks->count();
        $failed    = $course->tasks->filter(function ($task)
        {
            return $task->status == 'overdue';
        })->count();
        $approved  = $course->tasks->filter(function ($task)
        {
            return $task->status == 'finished';
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
            'approvedCount'      => $approved
        ]);
    }

    private function retrieveCourses(bool $withDescription = false, bool $finishedOnly = true)
    {
        $user     = User::firstWhere(['guid' => auth()->id()]);
        $statuses = \DB::table('projects')
            ->select('task_id', 'status')
            ->where('ownable_id', $user->id)
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
}
