<?php

use App\Models\Course;
use App\Models\CourseTrack;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->course = Course::factory()->create();
    $this->task = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at' => Carbon::create(2022, 8, 24, 23, 59, 59)
    ])->for($this->course)->create();
    $this->user = User::factory()->hasAttached($this->course)->create();
    Carbon::setTestNow(Carbon::create(2022, 8, 16));
});

test('canStart returns false if now is before the start time', function() {
    Carbon::setTestNow(Carbon::create(2022, 8, 3));
    $message = null;
    expect($this->task->canStart($this->user, $message))->toBeFalse();
    expect($message)->toBe('The task cannot be started outside of the task time frame');
});

test('canStart returns false if now is after the end time', function() {
    Carbon::setTestNow(Carbon::create(2022, 8, 29));

    expect($this->task->canStart($this->user))->toBeFalse();
});

test('canStart returns true if now is after the start time and before the end time', function() {
    expect($this->task->canStart($this->user))->toBeTrue();
});

test('canStart returns false if a group member has already begun the task', function () {
    $user2 = User::factory()->hasAttached($this->course)->create();
    Group::factory()->for($this->course)
        ->hasAttached($this->user)
        ->hasAttached($user2)
        ->create();
    Project::factory()->for($user2, 'ownable')->for($this->task)->createQuietly();

    expect($this->task->canStart($this->user))->toBeFalse();
});

test('canStart returns false if a group has already begun the task', function () {
    $group = Group::factory()->for($this->course)
        ->hasAttached($this->user)
        ->create();
    Project::factory()->for($group, 'ownable')->for($this->task)->createQuietly();

    expect($this->task->canStart($this->user))->toBeFalse();
});

test('canStart returns false if the task has already been started', function() {
    Project::factory()->for($this->user, 'ownable')->for($this->task)->createQuietly();

    expect($this->task->canStart($this->user))->toBeFalse();
});

test('canStart returns true if the task has not been started', function() {
    expect($this->task->canStart($this->user))->toBeTrue();
});

test('canStart returns true if the group has not started the task', function() {
    Group::factory()->for($this->course)
        ->hasAttached($this->user)
        ->create();

    expect($this->task->canStart($this->user))->toBeTrue();
});

test('canStart returns false if the user is not on the same track', function () {
    $root = CourseTrack::factory()->for($this->course)->create();
    $track1 = CourseTrack::factory()->for($root, 'parent')->create();
    $track2 = CourseTrack::factory()->for($root, 'parent')->create();

    $task1ForTrack1 = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at' => Carbon::create(2022, 8, 24, 23, 59, 59)
    ])->for($this->course)->for($track1, 'track')->create();

    $task2ForTrack2 = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at' => Carbon::create(2022, 8, 24, 23, 59, 59)
    ])->for($this->course)->for($track2, 'track')->create();

    Project::factory()->for($this->user, 'ownable')->for($task2ForTrack2)->createQuietly();

    expect($task1ForTrack1->canStart($this->user))->toBeFalse();
});

test('canStart returns true if the user is on the correct track', function() {
    $root = CourseTrack::factory()->for($this->course)->create();
    $track1 = CourseTrack::factory()->for($root, 'parent')->create();

    $task1ForTrack1 = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at' => Carbon::create(2022, 8, 24, 23, 59, 59)
    ])->for($this->course)->for($track1, 'track')->create();

    $task2ForTrack1 = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at' => Carbon::create(2022, 8, 24, 23, 59, 59)
    ])->for($this->course)->for($track1, 'track')->create();
    Project::factory()->for($this->user, 'ownable')->for($task2ForTrack1)->createQuietly();

    expect($task1ForTrack1->canStart($this->user))->toBeTrue();
});

test('canStart returns false if all group members are not on the same track', function() {
    $root = CourseTrack::factory()->for($this->course)->create();
    $track1 = CourseTrack::factory()->for($root, 'parent')->create();
    $track2 = CourseTrack::factory()->for($root, 'parent')->create();
    $group = Group::factory()->for($this->course)
        ->hasAttached($this->user)
        ->create();

    $task1ForTrack1 = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at' => Carbon::create(2022, 8, 24, 23, 59, 59)
    ])->for($this->course)->for($track1, 'track')->create();

    $task2ForTrack2 = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at' => Carbon::create(2022, 8, 24, 23, 59, 59)
    ])->for($this->course)->for($track2, 'track')->create();

    Project::factory()->for($group, 'ownable')->for($task2ForTrack2)->createQuietly();

    expect($task1ForTrack1->canStart($this->user))->toBeFalse();
});

