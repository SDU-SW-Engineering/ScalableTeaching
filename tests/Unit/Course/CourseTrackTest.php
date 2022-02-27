<?php

use App\Models\Course;
use App\Models\CourseTrack;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->course = Course::factory()->create();
    /** @var CourseTrack base */
    $this->base = CourseTrack::factory()->for($this->course)->create();
    $this->track1 = CourseTrack::factory()->for($this->course)->for($this->base, 'parent')->create();
    $this->track2 = CourseTrack::factory()->for($this->course)->for($this->base, 'parent')->create();
    $this->task = Task::factory()->for($this->track1, 'track')->for($this->course)->create();
});

test('creating a child track automatically populates the course_id from parent track', function() {
    $track = $this->base->children()->create([
        'name'        => 'test',
        'description' => 'testing'
    ]);

    expect($track->course_id)->toBe($this->base->course_id);
});

it('has siblings', function() {
    expect($this->track1->siblings()->pluck('id'))->toContain($this->track2->id);
    expect($this->track1->siblings()->pluck('id'))->not()->toContain($this->track1->id);
    expect($this->track2->siblings()->pluck('id'))->toContain($this->track1->id);
    expect($this->track2->siblings()->pluck('id'))->not()->toContain($this->track2->id);
});

it('ensures root nodes don\'t have siblings', function() {
    CourseTrack::factory()->for($this->course)->create();

    expect($this->base->siblings()->count())->toBe(0);
});

it('has a parent', function() {
    expect($this->track1->parent->id)->toBe($this->base->id);
});

it('has children', function() {

    $track3 = CourseTrack::factory()->for($this->course)->create();

    expect($this->base->children->pluck('id'))->toContain($this->track1->id, $this->track2->id);
    expect($this->base->children->pluck('id'))->not()->toContain($track3->id);
});

it('belongs to a course', function(){
    expect($this->base->course->id)->toBe($this->course->id);
});

it('has a root', function() {

    /** @var CourseTrack $track2 */
    $track2 = $this->track1->children()->create([
        'name' => 'track 2'
    ]);

    expect($track2->root()->id)->toBe($this->base->id);
});

it('has a path', function() {
    $track3 = CourseTrack::factory()->for($this->track1, 'parent')->create();

    expect($track3->path())->toBeCollection();
    expect($track3->path()->pluck('id')->toArray())->toBe([$track3->id, $this->track1->id, $this->base->id]);
});

test('isOn should return false if on the root node', function() {
    $user = User::factory()->hasAttached($this->course)->create();

    expect($this->base->isOn($user))->toBeFalse();
});

test('isOn returns true if the user has started a project on the current track', function() {
    $user = User::factory()->hasAttached($this->course)->create();
    Project::factory()->for($this->task)->for($user, 'ownable')->createQuietly();

    expect($this->track1->isOn($user))->toBeTrue();
});

test('isOn returns false if the user has not started a project on the current track', function() {
    $user = User::factory()->hasAttached($this->course)->create();

    expect($this->track1->isOn($user))->toBeFalse();
});

test('isOn returns true if the user belongs to a group that has started a project on the current track', function() {
    $user = User::factory()->hasAttached($this->course)->create();
    $group = Group::factory()->hasAttached($user)->for($this->course);
    Project::factory()->for($this->task)->for($group, 'ownable')->createQuietly();

    expect($this->track1->isOn($user))->toBeTrue();
});

test('isOn returns false if the user belongs to a group that has not started a project on the current track', function() {
    $user = User::factory()->hasAttached($this->course)->create();
    Group::factory()->hasAttached($user)->for($this->course);

    expect($this->track1->isOn($user))->toBeFalse();
});
