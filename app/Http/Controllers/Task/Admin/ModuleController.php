<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use App\Modules\ModuleService;

class ModuleController extends Controller
{
    public function index(Course $course, Task $task)
    {
        return view('tasks.admin.modules.index');
    }

    /**
     * @throws \Throwable
     */
    public function install(Course $course, Task $task, ModuleService $moduleService)
    {
        $validated = request()->validate([
            'module' => ['string', 'required']
        ]);
        $module = $moduleService->getById($validated['module']);
        if ($moduleService->hasInstallProblems($module, $task->module_configuration) != null)
            return redirect()->back();
        $moduleService->install($module, $task);

        return redirect()->back();
    }
}
