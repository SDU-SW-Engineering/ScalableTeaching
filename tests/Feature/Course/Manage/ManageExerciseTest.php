<?php

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\put;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->course = Course::factory()->create();
    $this->task1 = Task::factory()->exercise()->for($this->course)->create();
    $this->task2 = Task::factory()->exercise()->for($this->course)->create();
    $this->task3 = Task::factory()->exercise()->for($this->course)->create();
    $this->assignment = Task::factory()->assignment()->for($this->course)->create();

    $this->otherCourse = Course::factory()->create();
    $this->externalExercise = Task::factory()->exercise()->for($this->otherCourse)->create();

    $this->teacher = User::factory()->hasAttached($this->course, ['role' => 'teacher'])->create();
    $this->student = User::factory()->hasAttached($this->course)->create();
});

it('reorganizes exercises', function () {
    actingAs($this->teacher);

    put(route('courses.manage.exercises.reorganize', [$this->course]), [
        [
            'group' => 'test group',
            'id' => $this->task2->id,
        ],
        [
            'group' => 'test group2',
            'id' => $this->task3->id,
        ],
        [
            'group' => null,
            'id' => $this->task1->id,
        ],
    ]);

    assertDatabaseHas('tasks', [
        'id' => $this->task1->id,
        'order' => 3,
        'grouped_by' => null,
    ]);
    assertDatabaseHas('tasks', [
        'id' => $this->task2->id,
        'order' => 1,
        'grouped_by' => 'test group',
    ]);
    assertDatabaseHas('tasks', [
        'id' => $this->task3->id,
        'order' => 2,
        'grouped_by' => 'test group2',
    ]);
});

it('prevents assignments from being reorganized', function () {
    actingAs($this->teacher);

    put(route('courses.manage.exercises.reorganize', [$this->course]), [
        [
            'group' => 'test group',
            'id' => $this->task2->id,
        ],
        [
            'group' => 'test group2',
            'id' => $this->task3->id,
        ],
        [
            'group' => null,
            'id' => $this->task1->id,
        ],
        [
            'group' => null,
            'id' => $this->assignment->id,
        ],
    ])->assertStatus(400);
});

it('prevents external exercises from being being reorganized', function () {
    actingAs($this->teacher);

    put(route('courses.manage.exercises.reorganize', [$this->course]), [
        [
            'group' => 'test group',
            'id' => $this->task2->id,
        ],
        [
            'group' => 'test group2',
            'id' => $this->task3->id,
        ],
        [
            'group' => null,
            'id' => $this->task1->id,
        ],
        [
            'group' => null,
            'id' => $this->externalExercise->id,
        ],
    ])->assertStatus(400);
});

it('disallows students from reorganizes exercises', function () {
    actingAs($this->student);

    put(route('courses.manage.exercises.reorganize', [$this->course]), [
        [
            'group' => 'test group',
            'id' => $this->task2->id,
        ],
        [
            'group' => 'test group2',
            'id' => $this->task3->id,
        ],
        [
            'group' => null,
            'id' => $this->task1->id,
        ],
    ])->assertForbidden();
});
