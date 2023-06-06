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


it('creates an  task', closure: function() {
    postJson(route('courses.manage.storeTask', [$this->course]), [
        'name'    => 'Test Assignment',
    ])->assertStatus(200);

    assertDatabaseHas('tasks', [
        'name'              => 'Test Assignment',
    ]);
});
