<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class PreloadTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:preload {task}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $task = Task::findOrFail($this->argument('task'));
        $task->preload();

        return 0;
    }
}
