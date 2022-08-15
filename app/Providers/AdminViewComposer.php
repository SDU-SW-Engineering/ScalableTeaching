<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Task;
use Illuminate\View\View;

class AdminViewComposer
{
    public function compose(View $view)
    {
        if (!request()->route()->hasParameter('course') && request()->route()->hasParameter('task'))
            return;

        /** @var Course $course */
        $course = request()->route('course');
        /** @var Task $task */
        $task = request()->route('task');
        $breadcrumbs = [
            'Courses'     => route('courses.index'),
            $course->name => route('courses.show', $course->id),
            $task->name   => route('courses.tasks.show', [$course->id, $task->id]),
            'Analytics'   => null
        ];

        $view->with('breadcrumbs', $breadcrumbs);
        $view->with('task', $task);
        $view->with('course', $course);
    }
}
