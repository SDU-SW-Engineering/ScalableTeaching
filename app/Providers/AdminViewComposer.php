<?php

namespace App\Providers;

use Illuminate\View\View;

class AdminViewComposer
{
    public function compose(View $view)
    {
        if (!request()->route()->hasParameter('course') && request()->route()->hasParameter('task'))
            return;

        $course = request()->route('course');
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
