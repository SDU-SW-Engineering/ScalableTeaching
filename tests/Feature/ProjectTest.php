<?php

use App\Events\ProjectCreated;
use App\Listeners\GitLab\Project\DisableForking;
use App\Listeners\GitLab\Project\RefreshMemberAccess;
use App\Listeners\GitLab\Project\RegisterWebhook;
use App\Models\Course;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('ensures the ProjectCreated event is fired', function() {
    Event::fake();
    Project::factory()->for(Task::factory()->for(Course::factory()))->create();

    Event::assertDispatched(ProjectCreated::class);
});

it('ensures the RefreshMemberAccess is fired when ProjectCreated', function() {
    Event::fake();
    Project::factory()->for(Task::factory()->for(Course::factory()))->create();

    Event::assertListening(ProjectCreated::class, RefreshMemberAccess::class);
});


it('ensures the DisableForking event is fired when ProjectCreated', function() {
    Event::fake();
    Project::factory()->for(Task::factory()->for(Course::factory()))->create();

    Event::assertListening(ProjectCreated::class, DisableForking::class);
});

it('ensures the RegisterWebhook event is fired when ProjectCreated', function() {
    Event::fake();
    Project::factory()->for(Task::factory()->for(Course::factory()))->create();

    Event::assertListening(ProjectCreated::class, RegisterWebhook::class);
});
