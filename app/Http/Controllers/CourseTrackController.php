<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseTrack;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseTrackController extends Controller
{
    public function show(Course $course, CourseTrack $track) : View
    {
        $tasks = $course->tasks()->where('track_id', $track->id)->where('is_visible', true)->get()->map(fn(Task $task) => [
            'details' => $task,
            'project' => $task->currentProjectForUser(auth()->user()),
        ]);

        $trackBreadCrumbs = $track->path()
            ->mapWithKeys(fn($track, $index) => [$track->name => route('courses.tracks.show', [$course, $track])])
            ->reverse();

        return view('courses.tracks.show', [
            'course'      => $course,
            'track'       => $track,
            'tasks'       => $tasks,
            'breadcrumbs' => [
                'Courses'                => route('courses.index'),
                $course->name            => route('courses.show', $course),
                ...$trackBreadCrumbs,
            ],
        ]);
    }
}
