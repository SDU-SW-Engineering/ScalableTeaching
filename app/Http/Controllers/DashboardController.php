<?php

namespace App\Http\Controllers;

use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\TaskTypeEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() : View
    {
        $courses = auth()->user()->courses()->get();
        $tasks = Task::whereIn('course_id', $courses->pluck('id'))->assignments()->orderBy('ends_at', 'asc')->get();
        $oldTasks = Task::whereIn('course_id', $courses->pluck('id'))->assignments()->orderBy('ends_at', 'desc')->get();

        return view('dashboard', [
            'courses'     => $courses,
            'tasks'       => $tasks,
            'oldTasks'    => $oldTasks,
            'bg'          => 'bg-gray-100 dark:bg-gray-700',
            'breadcrumbs' => [
                'Dashboard' => null,
            ],
        ]);
    }
}
