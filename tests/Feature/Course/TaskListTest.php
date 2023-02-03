<?php

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->course = Course::factory()->create();
    $this->task = Task::factory()->exercise()->for($this->course)->create([
        'name' => 'visible task',
    ]);
    $this->invisibleTask = Task::factory()->invisible()->exercise()->for($this->course)->create([
        'name' => 'invisible task',
    ]);
});

it('allows teachers to view invisible tasks', function () {
    $teacher = User::factory()->hasAttached($this->course, ['role' => 'teacher'])->create();
    actingAs($teacher);

    $this->get(route('courses.show', $this->course))
        ->assertSee('invisible task');
});

it('disallows student from viewing invisible tasks', function () {
    $student = User::factory()->hasAttached($this->course)->create();
    actingAs($student);

    $this->get(route('courses.show', $this->course))
        ->assertSee('visible task')
        ->assertDontSee('invisible task');
});

it('shows tasks visibility for teachers', function () {
    $teacher = User::factory()->hasAttached($this->course, ['role' => 'teacher'])->create();
    actingAs($teacher);

    $this->get(route('courses.show', $this->course))
        ->assertSee('task-visibility');
});

it('hides tasks visibility for studetns', function () {
    $student = User::factory()->hasAttached($this->course)->create();
    actingAs($student);

    $this->get(route('courses.show', $this->course))
        ->assertDontSee('task-visibility');
});
