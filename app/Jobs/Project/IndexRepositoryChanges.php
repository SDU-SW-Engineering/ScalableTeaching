<?php

namespace App\Jobs\Project;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IndexRepositoryChanges implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public Project $project, public string $comparisonSha)
    {
        dd($this->project, $this->comparisonSha);

        exec("docker run jazerix/git-diff:latest https://:PATqrSyRAaE9Fa1JHGzR5z7@gitlab.sdu.dk/scalable-teaching-tasks/web-technologies-e22/assignment1/disciples-of-niels.git ac5b639436b9c9230ca6d359420bb2a61e848421 a2d6ec2d 2>&1", $output, $code);

        dd($output, $code);
        if($output == null) {
            dd("unable to load");
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
