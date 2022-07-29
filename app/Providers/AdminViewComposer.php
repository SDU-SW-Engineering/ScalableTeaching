<?php

namespace App\Providers;

use Illuminate\View\View;

class AdminViewComposer
{
    public function compose(View $view)
    {
        $data = collect($view->getData());

        if (!$data->contains(fn($item, $key) => $key == 'course' || $key == 'task'))
            return;

        $course = $data->get('course');
        $task = $data->get('task');
        $breadcrumbs = [
            'Courses'     => route('courses.index'),
            $course->name => route('courses.show', $course->id),
            $task->name   => route('courses.tasks.show', [$course->id, $task->id]),
            'Analytics'   => null
        ];

        $view->with('breadcrumbs', $breadcrumbs);
    }
}
