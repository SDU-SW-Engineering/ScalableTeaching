<?php

namespace App\Providers;

use App\Modules\Kernel;
use App\Modules\Module;
use App\Modules\ModuleService;
use App\Modules\Template\Template;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws \Throwable
     */
    public function register(): void
    {
        $this->app->singleton(ModuleService::class);

        $moduleService = $this->app->get(ModuleService::class);
        $kernel = new Kernel;
        foreach($kernel->modules as $module) {
            /** @var Module $module */
            $moduleService->registerModule($module);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $kernel = new Kernel;
        foreach($kernel->modules as $module) {
            /** @var Module $module */
            $module = new $module;
            $id = $module->identifier();
            $groupName = str($id)->camel()->toString();
            $this->loadViewsFrom(app_path("Modules/$id/Views"), "module-$id");
            Route::prefix("courses/{course}/tasks/{task}/admin/modules/{$module->identifier()}")
                ->middleware(['web', 'auth', 'can:viewDashboard,task', 'moduleInstalled'])
                ->as(strtolower("courses.tasks.admin.$groupName."))
                ->group(function() use ($module) {
                    $module::configRoutes();
                });
        }
    }
}
