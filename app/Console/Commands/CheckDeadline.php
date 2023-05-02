<?php

namespace App\Console\Commands;

use App\Models\VisualizationServer;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class CheckDeadline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visualizations:kill-overdue-shiny-servers';

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
        $visualizationServerOverdue = VisualizationServer::where('deadline', '<', now())->where('is_running', true)->get();
        //dd($visualizationServerOverdue);
        //sdd($visualizationServerOverdue->last()->container_id);
        /*$removeNewLine = str_replace('\n', '', $visualizationServerOverdue->last()->container_id);
        echo $removeNewLine;
        dd($removeNewLine);*/

        //$process = new Process(['docker', 'kill', $visualizationServerOverdue->last()->container_id]);
        //$process->run();
        //echo $process->getOutput();
        //echo $process->getCommandLine();
        foreach ($visualizationServerOverdue as $vis) {
            $process = new Process(['docker', 'kill', $vis->container_id]);
            $process->run();
            $vis->is_running = false;
            $vis->save();
            echo $process->getOutput();
            //echo $process->getCommandLine();

        }
        //dd($visualizationServerOverdue->first()->container_id);

    }
}
