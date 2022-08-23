<?php

namespace Tests\Feature\Course;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function Pest\Laravel\actingAs;
use function Tests\Feature\factory;

uses(RefreshDatabase::class);

it('allows admins to create courses', function () {
    $admin = User::factory()->admin()->create();
    actingAs($admin);
    //$this->get('/courses')->assertDontSee('WebTechnologies');

    $this->followingRedirects()->post('/courses', [
        'course-name' => 'WebTechnologies',
    ])->assertStatus(200)->assertSee('WebTechnologies');

    $this->assertDatabaseHas('courses', [
        'name' => 'WebTechnologies',
    ]);
});

it('verifies that the name field is filled during course creation', function () {
    $admin = User::factory()->admin()->create();
    actingAs($admin);

    $response = $this->post('/courses');

    $response->assertSessionHasErrors(['course-name']);
});
