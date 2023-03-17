<?php

namespace App\Console\Commands;

use App\Jobs\Pipeline\RefreshPipeline;
use App\Models\Pipeline;
use Illuminate\Console\Command;

/**
 * Some pipelines do not always make it through, as such we need to refresh those that did not get fully updated
 */
class RefreshStalePipelines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pipelines:refresh-stale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh pipelines that not finished (pending / running) after 2 hours of not hearing anything.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() : int
    {
        Pipeline::stale()->latest()->each(function(Pipeline $pipeline, $index) {
            RefreshPipeline::dispatch($pipeline)->delay(now()->addSeconds($index * 5));
        });
        $this->info('Stale pipelines have been queue for refresh.');
        return 0;
    }
}
