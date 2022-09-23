<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use Domain\Analytics\Graph\DataSets\BarDataSet;
use Domain\Analytics\Graph\Graph;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function students(Course $course, Task $task): View
    {
        return view('tasks.admin.students', compact('course', 'task'));
    }

    public function builds(Course $course, Task $task)
    {
        $dailyBuilds = $task->dailyBuilds(true, true);
        $activeIndex = $dailyBuilds->keys()->search(\request('q'));
        $dailyBuildsGraph = new Graph($dailyBuilds->keys(), new BarDataSet("Builds", $dailyBuilds->values(), "#4F535B", $activeIndex === false ? null : $activeIndex));
        $buildQuery = $task->jobs();

        if(\request('q') != null)
            $buildQuery->whereRaw('date(pipelines.created_at) = ?', \request('q'));

        if(\request('status') != null)
            $buildQuery->where('pipelines.status', \request('status'));

        $buildQuery->latest();
        $builds = $buildQuery->paginate(25)->withQueryString();
        return view('tasks.admin.builds', compact('course', 'task', 'dailyBuildsGraph', 'builds'));
    }

    public function pushes(Course $course, Task $task)
    {

    }
}
