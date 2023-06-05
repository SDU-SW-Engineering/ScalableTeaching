<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Casts\SubTask;
use App\Models\Casts\SubTaskCollection;
use App\Models\Course;
use App\Models\Task;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ProgressionController extends Controller
{
    public function subTasks(Course $course, Task $task): View
    {
        $subTasks = $task->sub_tasks->all()->groupBy("group")->map(fn($tasks, $group) => [
            'name'    => $group,
            'tasks'   => $tasks->map(fn(SubTask $t) => [
                'id'      => $t->id,
                'name'    => $t->getName(),
                'points'  => $t->points,
            ]),
        ])->values();

        return view('tasks.admin.subtasks', [
            'subTasks' => $subTasks,
        ]);
    }

    public function saveSubTasks(Course $course, Task $task): string
    {
        $subTaskCollection = new SubTaskCollection();
        (new Collection(request()->json()))->map(fn($group) => [
            ...(new Collection($group['tasks']))->map(fn($task) => (new SubTask($task['name'], null, $group['name']))->setPoints($task['points'])),
        ])->flatten()
            ->each(fn(SubTask $subTask) => $subTaskCollection->add($subTask));
        $task->sub_tasks = $subTaskCollection;
        $task->save();

        return "OK";
    }
}
