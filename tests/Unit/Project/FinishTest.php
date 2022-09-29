<?php

use App\Models\Course;
use App\Models\Project;
use App\Models\Task;
use App\ProjectStatus;
use Carbon\Carbon;
use function Pest\Laravel\assertDatabaseHas;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('sets the finished_at timestamp when a project is marked as finished', function() {
    Carbon::setTestNow(Carbon::create(2022, 1, 23, 12, 0, 0));
    /** @var Project $project */
    $project = Project::factory()->for(Task::factory()->for(Course::factory()))->createQuietly();
    $project->setProjectStatus(ProjectStatus::Finished);

    assertDatabaseHas('projects', [
        'id'          => $project->id,
        'status'      => ProjectStatus::Finished->value,
        'finished_at' => Carbon::create(2022, 1, 23, 12, 0, 0),
    ]);
});
