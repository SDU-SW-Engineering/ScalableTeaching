<?php

use App\Models\Course;
use App\Models\CourseTrack;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->course = Course::factory()->create();
    $this->root = CourseTrack::factory()->for($this->course)->create(['name' => 'Root Track']);
    $this->track1 = CourseTrack::factory(['name' => 'Hello World', 'description' => 'dcba'])->for($this->course)->for($this->root, 'parent')->create();
    $this->track2 = CourseTrack::factory(['name' => 'Hello Miguel', 'description' => 'abcd'])->for($this->course)->for($this->root, 'parent')->create();
    $this->task = Task::factory()->for($this->course)->for($this->track1, 'track')->create();
    $this->task2 = Task::factory()->for($this->course)->for($this->track2, 'track')->create();
    $this->user = User::factory()->hasAttached($this->course)->create();
});

it('allows a student to inspect tracks', function() {
    actingAs($this->user);
    get("/courses/{$this->course->id}")
        ->assertStatus(200)->assertSee('Root Track')->assertDontSee('Hello World');
    get("/courses/{$this->course->id}/tracks/{$this->root->id}")->assertStatus(200)
        ->assertSee('Hello World')
        ->assertSee('Hello Miguel');
    get("/courses/{$this->course->id}/tracks/{$this->track1->id}")
        ->assertStatus(200)->assertSee('Hello World')
        ->assertDontSee('Hello Miguel');
});

it('responds with 404 if navigating to a task that don\'t exist', function() {
    actingAs($this->user);
    get("/courses/{$this->course->id}/tracks/12341")
        ->assertStatus(404);
});

it('allows students to pick one task from a track that has two paths', function() {
    actingAs($this->user);

})->skip(); // todo: gitlab actions should be extracted into a service so they can be mocked during testing

it('does not allow students to start projects that does not follow the track path')->skip();
