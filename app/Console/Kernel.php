<?php

namespace App\Console;

use App\Console\Commands\Export\TaskStatus;
use App\Console\Commands\LoadCurrentProjects;
use App\Console\Commands\LoadOldReports;
use App\Console\Commands\MarkExpiredProjects;
use App\Console\Commands\MoveGrades;
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
        LoadOldReports::class,
        MarkExpiredProjects::class,
        TaskStatus::class,
        MoveGrades::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('tasks:mark-expired')->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
