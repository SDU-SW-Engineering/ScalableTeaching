<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Task;
use App\Models\TaskDelegation;
use Illuminate\View\View;

class AdminViewComposer
{
    public function compose(View $view) : void
    {
        if ( ! request()->route()->hasParameter('course') && request()->route()->hasParameter('task'))
            return;

        /** @var Course $course */
        $course = request()->route('course');
        /** @var Task $task */
        $task = request()->route('task');
        $breadcrumbs = [
            'Courses'     => route('courses.index'),
            $course->name => route('courses.show', $course->id),
            $task->name   => route('courses.tasks.show', [$course->id, $task->id]),
            'Analytics'   => null,
        ];


        $view->with(
            'commentCount',
            $task->delegations()
                ->with('comments')
                ->get()->map(fn(TaskDelegation $taskDelegation) => $taskDelegation->comments)
            ->flatten()->count()
        );
        $view->with('breadcrumbs', $breadcrumbs);
        $view->with('task', $task);
        $view->with('course', $course);
    }
}
