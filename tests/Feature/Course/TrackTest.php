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
    $this->root = CourseTrack::factory()->for($this->course)->create();
    $this->track1 = CourseTrack::factory(['name' => 'Hello World', 'description' => 'dcba'])->for($this->course)->for($this->root, 'parent')->create();
    $this->track2 = CourseTrack::factory(['name' => 'Hello Miguel', 'description' => 'abcd'])->for($this->course)->for($this->root, 'parent')->create();
    $this->task = Task::factory()->for($this->course)->for($this->track1, 'track')->create();
    $this->task2 = Task::factory()->for($this->course)->for($this->track2, 'track')->create();
    $this->user = User::factory()->hasAttached($this->course)->create();
});

it('allows a student to inspect tracks', function() {
    actingAs($this->user);
    get("/courses/{$this->course->id}")->assertStatus(200)->assertSee('Hello World');
    get("/courses/{$this->course->id}/tracks")->assertStatus(200)
        ->assertSee('Hello World')
        ->assertSee('abcd')
        ->assertSee('Hello Miguel')
        ->assertSee('dcba');
    get("/courses/{$this->course->id}/tracks/$this->track1")
        ->assertStatus(200)->assertSee('Hello World')
        ->assertDontSee('Hello Miguel')
        ->assertSee('abcd')
        ->assertDontSee('dcba');
});

it('responds with 404 if navigating to a task that don\'t exist');

it('allows students to pick one task from a track that has two paths', function() {
    actingAs($this->user);

});

it('does not allow students to start projects that does not follow the track path');

it('disallows students from changing path after one has been picked');
