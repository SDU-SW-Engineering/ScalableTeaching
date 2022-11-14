<?php

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);


beforeEach(function() {
    $this->course = Course::factory()->create();
    $this->oldExercise = Task::factory()->exercise()->for($this->course)->create([
        'name'       => 'old exercise',
        'created_at' => date('2022-11-10'),
    ]);
    $this->newExercise = Task::factory()->exercise()->for($this->course)->create([
        'name'       => 'new exercise',
        'created_at' => date('2022-11-13'),
    ]);
});

it('tests exercises are ordered by desc', function () {
    $student = User::factory()->hasAttached($this->course)->create();
    actingAs($student);

    $this->assertEquals('new exercise', Task::exercises()->whereIn('course_id', $this->course->pluck('id'))->orderBy('created_at', 'desc')->visible()->first()->name);
});
