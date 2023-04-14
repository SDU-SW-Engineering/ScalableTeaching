<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Modules\PlagiarismDetection\DetectionMethods\JPlag\JPlag;
use Illuminate\Console\Command;

class PlagiarismAnalysis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:plagiarism-detection {task} {method}';

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
     * @throws \Exception
     */
    public function handle()
    {
        $detection = match (str($this->argument('method'))->trim()->lower()->toString()) {
            'jplag' => new JPlag(),
            default => throw new \Exception("Invalid method!")
        };
        $task = Task::findOrFail($this->argument('task'));
        dd($detection->analyze($task));
        return 0;
    }
}
