<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EnsureModuleInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Task $task */
        $task = $request->route()->parameter('task');
        abort_if($task == null, 400, 'Module can only be installed on tasks.');
        throw_if(is_string($task), "Task route parameter should be an instance of the Task model, have you typehinted your controller methods?");

        $parts = Str::of($request->route()->uri)->split('/\//');
        $index = $parts->filter(fn(string $part, int $index) => strtolower($part) == 'modules')->flip()->first();
        $module = $parts->slice($index)->values()->slice(1, 1)->first();
        abort_if($module == null, 404, 'Module not installed');
        $resolvedModule = $task->module_configuration->resolveModule($module);

        $request->route()->setParameter('module', $resolvedModule);

        return $next($request);
    }
}
