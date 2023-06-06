<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use App\Modules\Module;
use App\Modules\ModuleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ReflectionClass;

class ModuleController extends Controller
{
    public function index(Course $course, Task $task) : View
    {
        return view('tasks.admin.modules.index');
    }

    /**
     * @throws \Throwable
     */
    public function install(Course $course, Task $task, ModuleService $moduleService) : RedirectResponse
    {
        $validated = request()->validate([
            'module' => ['string', 'required'],
        ]);
        $module = $moduleService->getById($validated['module']);
        if($moduleService->hasInstallProblems($module, $task->module_configuration) != null)
            return redirect()->back();
        $moduleService->install($module, $task);

        return redirect()->back();
    }

    /**
     * @throws \ReflectionException
     */
    public function configure(Course $course, Task $task, Module $module) : View
    {
        $variables = [];
        $reflect = new ReflectionClass($module->settings());
        foreach($reflect->getProperties() as $property)
        {
            $variables[$property->getName()] = $property->getValue($module->settings());
        }

        return view('tasks.admin.modules.configure', compact('module'))->with($variables);
    }

    /**
     */
    public function doConfigure(Course $course, Task $task, Module $module, Request $request) : RedirectResponse
    {
        $settings = $module->settings();
        if($settings == null)
            return redirect()->back();
        $request->validate($settings->validationRules());
        $reflect = new ReflectionClass($settings);
        foreach($reflect->getProperties() as $property)
        {
            if($request->has($property->getName()))
                $property->setValue($settings, $request->get($property->getName()));
        }
        $task->module_configuration->update($module->identifier(), $settings);
        $task->save();

        return redirect()->back();
    }

    public function uninstall(Course $course, Task $task, Module $module) : RedirectResponse
    {
        $task->module_configuration->uninstall($module);
        $task->save();

        return redirect()->back();
    }
}
