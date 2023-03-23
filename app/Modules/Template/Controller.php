<?php

namespace App\Modules\Template;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\Task;
use App\Modules\Module;

class Controller extends BaseController
{
    public function pushes(Course $course, Task $task, Module $module)
    {
    }
}
