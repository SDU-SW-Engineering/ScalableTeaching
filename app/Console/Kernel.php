<?php

namespace App\Console;

use App\Console\Commands\Export\TaskStatus;
use App\Console\Commands\LoadCurrentProjects;
use App\Console\Commands\MarkExpiredProjects;
use App\Console\Commands\MoveGrades;
use App\Console\Commands\PreloadTask;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        LoadCurrentProjects::class,
        MarkExpiredProjects::class,
        TaskStatus::class,
        MoveGrades::class,
        PreloadTask::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('tasks:mark-expired')->everyFiveMinutes();
        $schedule->command('tasks:delegate')->everyFifteenMinutes();
        $schedule->command('pipelines:refresh-stale')->everyThirtyMinutes();
        $schedule->command('tasks:preload')->everyThirtyMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
