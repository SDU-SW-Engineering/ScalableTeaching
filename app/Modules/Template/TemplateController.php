<?php

namespace App\Modules\Template;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\Task;
use App\Modules\Module;
use Illuminate\View\View;

class TemplateController extends BaseController
{
    /**
     * Note: Local development will not have any actual pushes, since the remote gitlab server can not register a local webhook reliably.
     */
    public function pushes(Course $course, Task $task) : View
    {
        $pushes = $task->pushes()->with(['project.ownable'])->latest()->paginate(50);

        return view('module-Template::pushes', compact('pushes'));
    }
}

