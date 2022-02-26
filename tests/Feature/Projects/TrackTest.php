<?php

use App\Models\Course;
use App\Models\CourseTrack;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->course = Course::factory()->create();
    $this->track = CourseTrack::factory()->for($this->course)->create();
    $this->branch1 = CourseTrack::factory()->for($this->course)->for($this->track, 'parent')->create();
    $this->branch2 = CourseTrack::factory()->for($this->course)->for($this->track, 'parent')->create();
    $this->task = Task::factory()->for($this->course)->for($this->branch1, 'track')->create();
    $this->task2 = Task::factory()->for($this->course)->for($this->branch2, 'track')->create();
    $this->user = User::factory()->hasAttached($this->course)->create();
});

it('allows a student to inspect a track');

it('allows students to pick one task from a track that has two paths', function() {
    actingAs($this->user);

});

it('does not allow students to start projects that does not follow the track path');

it('disallows students from changing path after one has been picked');
