<?php

namespace App\Jobs\Course;

use Domain\SourceControl\SourceControl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddMemberToCourseGroup implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public int $gitlabUser, public int $groupId, public int $level = 20) // 20 = reporter
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        app(SourceControl::class)->addUserToGroup($this->groupId, $this->gitlabUser, $this->level);
    }
}
