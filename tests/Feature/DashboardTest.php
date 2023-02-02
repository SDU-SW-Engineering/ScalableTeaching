<?php

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);


beforeEach(function() {
    $this->oldCourse = Course::factory()->create([
        'name'       => 'old course',
        'created_at' => date('2022-11-10'),
    ]);

    $this->newCourse = Course::factory()->create([
        'name'       => 'new course',
        'created_at' => date('2022-11-13'),
    ]);

    $this->oldExercise = Task::factory()->exercise()->for($this->oldCourse)->create([
        'name'       => 'old exercise',
        'created_at' => date('2022-11-10'),
    ]);

    $this->newExercise = Task::factory()->exercise()->for($this->oldCourse)->create([
        'name'       => 'new exercise',
        'created_at' => date('2022-11-13'),
    ]);

    $this->nearestAssignment = Task::factory()->assignment()->for($this->oldCourse)->create([
       'name'       => 'nearest assignment',
       'ends_at'    => Carbon::now()->addWeek(),
    ]);

    $this->furthestAssignment = Task::factory()->assignment()->for($this->oldCourse)->create([
        'name'       => 'furthest assignment',
        'ends_at'    => Carbon::now()->addMonth(),
    ]);
});

it('tests courses are ordered by desc', function () {
    $student = User::factory()->hasAttached([$this->oldCourse, $this->newCourse])->create();
    actingAs($student);

    $this->get(route('home'))
        ->assertSeeInOrder(['new course', 'old course']);
});

it('tests exercises are ordered by desc', function () {
    $student = User::factory()->hasAttached([$this->oldCourse, $this->newCourse])->create();
    actingAs($student);

    $this->get(route('home'))
        ->assertSeeInOrder(['new exercise', 'old exercise']);
});

it('tests assignments are ordered by nearest deadline', function () {
    $student = User::factory()->hasAttached([$this->oldCourse, $this->newCourse])->create();
    actingAs($student);

    $this->get(route('home'))
        ->assertSeeInOrder(['nearest assignment', 'furthest assignment']);
});
