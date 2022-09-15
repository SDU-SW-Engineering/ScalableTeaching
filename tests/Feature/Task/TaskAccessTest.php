<?php

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);


beforeEach(function() {
    $this->course = Course::factory()->create();
    $this->invisibleTask = Task::factory()->invisible()->exercise()->for($this->course)->create([
        'name' => 'invisible task',
    ]);
});

it('allows teachers to access invisible tasks', function() {
    $teacher = User::factory()->hasAttached($this->course, ['role' => 'teacher'])->create();
    actingAs($teacher);

    $this->get(route('courses.tasks.show', [$this->course, $this->invisibleTask]))
        ->assertStatus(200);
});

it('disallows students from accessing invisible tasks', function() {
    $student = User::factory()->hasAttached($this->course)->create();
    actingAs($student);

    $this->get(route('courses.tasks.show', [$this->course, $this->invisibleTask]))
        ->assertStatus(401);
});
