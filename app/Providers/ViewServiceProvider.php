<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Task;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('courses.manage.*', function(View $view) {
            /** @var Course $course */
            $course = request()->route('course');

            $breadcrumbs = [
                'Courses'     => route('courses.index'),
                $course->name => route('courses.show', $course->id),
                'Management'  => null,
            ];
            $view->with('breadcrumbs', $breadcrumbs);

            $view->with('course', $course);
        });

        \View::composer('tasks.analytics.*', function(View $view) {
            $course = request()->route('course');
            $task = request()->route('task');

            if( ! ($course instanceof Course && $task instanceof Task))
                return;

            $view->with('course', $course);
            $view->with('task', $task);

            $breadcrumbs = [
                'Courses'     => route('courses.index'),
                $course->name => route('courses.show', $course->id),
                $task->name   => route('courses.tasks.show', [$course->id, $task->id]),
                'Analytics'   => null,
            ];
            $view->with('breadcrumbs', $breadcrumbs);
        });

        \View::composer('tasks.admin.*', AdminViewComposer::class);
    }
}
