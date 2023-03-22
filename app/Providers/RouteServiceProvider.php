<?php

namespace App\Providers;

use App\Models\Task;
use App\Modules\ModuleService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';


    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $stagingMiddleware = app()->environment('staging') ? ['staging'] : [];

        Route::bind('module', function(string $value, \Illuminate\Routing\Route $route) {
            $task = Task::findOrFail($route->parameter('task'));
            abort_unless($task->module_configuration->hasInstalled($route->parameter('module')), 500, 'Module not installed');
            return $task->module_configuration->resolveModule($route->parameter('module'));
        });

        $this->routes(function() use ($stagingMiddleware) {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware(['web', ...$stagingMiddleware])
                ->namespace($this->namespace)
                ->group(base_path('routes/web/web.php'));

            if(app()->environment('staging', 'local'))
            {
                Route::prefix('staging')
                    ->middleware(['web'])
                    ->name($this->namespace)
                    ->group(base_path('routes/web/staging.php'));
            }

            Route::middleware(['web', 'auth'])
                ->as('courses.')
                ->prefix('courses')
                ->namespace($this->namespace)
                ->group(base_path('routes/web/course.php'));

            Route::middleware(['web', 'auth'])
                ->as('courses.tasks.')
                ->prefix('courses/{course}/tasks')
                ->namespace($this->namespace)
                ->group(base_path('routes/web/task.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function(Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
