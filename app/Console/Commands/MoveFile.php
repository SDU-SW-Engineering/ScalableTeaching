<?php

namespace App\Console\Commands;

use App\Models\Project;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class MoveFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:moveFile {task}';

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
    public function handle()
    {
        $task = Task::findOrFail($this->argument('task'));
        $originalPath = $task->downloads()->pluck('location')->first();
        $ref = $task->downloads()->pluck('ref')->first();
        $repoName = Project::findOrFail($task->downloads()->pluck('project_downloads.project_id')->first())->repo_name;

        //$contents = Storage::get($originalPath);

        if ( ! Storage::exists('newDir'))
        {
            Storage::makeDirectory('newDir');
        }

        $pathToP1 = Storage::path('newDir/').$repoName.'-'.$ref.'-'.$ref.'/P1';
        $shinyPath = ':/srv/shiny-server/';

        $zip = new ZipArchive;
        if ($zip->open(Storage::path($originalPath)) === TRUE)
        {
            $zip->extractTo((Storage::path('newDir')));
            $zip->close();
            //Storage::move($originalPath, $baseDir);
            //return redirect()->back();
        } else
        {
            echo 'failed';
        }

        $process = new Process(['sudo', 'docker', 'run', '--rm', '-v', $pathToP1.$shinyPath, '-p', '3838:3838', '-d', 'christen97/shiny-server:firsttry']);
        $process->start();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();
    }
}
