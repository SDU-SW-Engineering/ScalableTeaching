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
        'course-name' => 'WebTechnologies'
    ])->assertStatus(200)->assertSee('WebTechnologies');
});

it('tests validation of name', function () {
    $admin = User::factory()->admin()->create();
    actingAs($admin);
    $this->assertionSessionHasErrors([
       'name' => 'The name field is required'
    ]);
});
