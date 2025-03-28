<?php

namespace App\Events;

use App\Models\Project;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjectDeleting
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Project $project;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }
}
