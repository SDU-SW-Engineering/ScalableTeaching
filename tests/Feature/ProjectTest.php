<?php

use App\Listeners\GitLab\Project\RegisterWebhook;
use App\Models\Course;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it("ensures the ", function() {

    Project::factory()->for(Task::factory()->for(Course::factory()))->create();
});
