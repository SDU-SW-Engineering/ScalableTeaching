<?php

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->course = Course::factory()->create();
    $this->user = User::factory()->admin()->hasAttached($this->course)->create();
    actingAs($this->user);
});


it('creates an exercise task', closure: function() {
    postJson(route('courses.manage.storeTask', [$this->course]), [
        'name' => 'Test Assignment',
        'type' => 'exercise'
    ])->dump()->assertStatus(200);

    assertDatabaseHas('tasks', [
        'type' => 'exercise',
        'name' => 'Test Assignment'
    ]);
});

it('creates a repo-backed exercise task', closure: function() {
    postJson(route('courses.manage.storeTask', [$this->course]), [
        'name'    => 'Test Assignment',
        'type'    => 'exercise',
        'repo-id' => '123'
    ])->dump()->assertStatus(200);

    assertDatabaseHas('tasks', [
        'type'             => 'exercise',
        'name'             => 'Test Assignment',
        'source_project_id' => '123'
    ]);
});


it('creates an assignment task', closure: function() {
    postJson(route('courses.manage.storeTask', [$this->course]), [
        'name'    => 'Test Assignment',
        'type'    => 'assignment',
        'repo-id' => '123'
    ])->assertStatus(200);

    assertDatabaseHas('tasks', [
        'type'              => 'assignment',
        'name'              => 'Test Assignment',
        'source_project_id' => '123'
    ]);
});

it('is unable create an assignment task without a backing repo', closure: function() {
    $response = postJson(route('courses.manage.storeTask', [$this->course]), [
        'name' => 'Test Assignment',
        'type' => 'assignment',
    ])->assertStatus(422);

    $response->assertJsonValidationErrors(['repo-id']);
});
