<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use App\Modules\Module;
use App\Modules\ModuleService;
use Illuminate\Http\Request;

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
        if($moduleService->hasInstallProblems($module, $task->module_configuration) != null)
            return redirect()->back();
        $moduleService->install($module, $task);

        return redirect()->back();
    }

    public function configure(Course $course, Task $task, Module $module)
    {
        $variables = [];
        foreach($module->settings() as $property => $value)
            $variables[$property] = $value;

        return view('tasks.admin.modules.configure', compact('module'))->with($variables);
    }

    /**
     */
    public function doConfigure(Course $course, Task $task, Module $module, Request $request)
    {
        $settings = $module->settings();
        if($settings == null)
            return redirect()->back();
        $request->validate($settings->validationRules());
        //$task->module_configuration; // this step is important as it ensures that the correct module configuratin is loaded on the task before we save to it
        foreach($settings as $property => $value) {
            if($request->has($property))
                $settings->$property = $request->get($property);
        }
        $task->module_configuration->update($module->identifier(), $settings);
        $task->save();

        return redirect()->back();
    }
}
