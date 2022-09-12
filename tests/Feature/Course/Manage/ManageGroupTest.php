<?php

use App\Models\Course;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\followingRedirects;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->course = Course::factory()->create();

    $this->teacher = User::factory()->hasAttached($this->course, ['role' => 'teacher'])->create();
    $this->student1 = User::factory()->hasAttached($this->course)->create();
    $this->student2 = User::factory()->hasAttached($this->course)->create();

    $this->group = Group::factory()->for($this->course)->create([
        'name' => 'WebTech Elites'
    ]);
    $this->group2 = Group::factory()->for($this->course)->create([
        'name' => 'Spartans'
    ]);
    $this->groupUser = User::factory()->hasAttached($this->course)->create([
        'name'  => 'WebTech User',
        'email' => 'web@tech.dk'
    ]);
    $this->groupUser->groups()->attach($this->group);
    $this->task = Task::factory()->for($this->course)->create();
    $this->project = Project::factory()->for($this->task)->for($this->group, 'ownable')->createQuietly();

    actingAs($this->teacher);
});

it('displays a courses groups', function() {
    get(route('courses.manage.groups.index', $this->course->id))
        ->assertSee('WebTech Elites')
        ->assertSee('Spartans')
        ->assertSee('1 projects')
        ->assertSee('0 projects');
});

it('filters a group based on name', function() {
    get(route('courses.manage.groups.index', [$this->course, 'filter' => 'Spart']))
        ->assertSee('Spartans')
        ->assertDontSee('WebTech Elites');
});

it('filters a group based on a group member', function() {
    get(route('courses.manage.groups.index', [$this->course, 'filter' => 'WebTech User']))
        ->assertSee('WebTech Elites')
        ->assertDontSee('Spartans');
});

it('displays an individual group', function() {
    get(route('courses.manage.groups.show', [$this->course->id, $this->group->id]))
        ->assertSee('WebTech Elites')
        ->assertSee('Projects: 1')
        ->assertSee('WebTech User')
        ->assertSee('web@tech.dk');
});

it('cannot create a group without a name', function() {
    post(route('courses.manage.groups.create', $this->course), [])
        ->assertSessionHasErrors('name');
});

it('creates a group', function() {
    post(route('courses.manage.groups.create', $this->course), [
        'name' => 'Test Group'
    ])->assertSessionHas('success');

    assertDatabaseHas('groups', [
        'name'      => 'Test Group',
        'course_id' => $this->course->id
    ]);
});

it('deletes a group', function() {
    delete(route('courses.manage.groups.delete', [$this->course, $this->group]))
        ->assertRedirect(route('courses.manage.groups.index', [$this->course]))
        ->assertSessionHas('success', 'Group deleted');

    assertDatabaseMissing('groups', [
        'name'      => 'WebTech Elites',
        'course_id' => $this->course->id
    ]);
});

it('fails to add a member that is not part of the course', function() {
    $user = User::factory()->hasAttached(Course::factory()->create())->create([
        'name'  => 'Test user',
        'email' => 'test@tech.dk'
    ]);

    put(route('courses.manage.groups.add-member', [$this->course, $this->group]), [
        'user' => $user->id
    ])->assertRedirect(route('courses.manage.groups.show', [$this->course, $this->group]))
        ->assertSessionHasErrors('name');

    assertDatabaseMissing('group_user', [
        'group_id' => $this->group->id,
        'user_id'  => $user->id,
    ]);
});

it('adds a member to a group', function() {
    $user = User::factory()->hasAttached($this->course)->create([
        'name'  => 'Test user',
        'email' => 'test@tech.dk'
    ]);

    put(route('courses.manage.groups.add-member', [$this->course, $this->group]), [
        'user' => $user->id
    ])->assertSessionHas('success', 'Test user added')
        ->assertRedirect(route('courses.manage.groups.show', [$this->course, $this->group]));

    assertDatabaseHas('group_user', [
        'group_id' => $this->group->id,
        'user_id'  => $user->id,
    ]);
});

it('removes a member from a group', function() {
    $user = User::factory()->hasAttached($this->course)->create([
        'name'  => 'Test user',
        'email' => 'test@tech.dk'
    ]);
    $user->groups()->attach($this->group);

    delete(route('courses.manage.groups.remove-member', [$this->course, $this->group]), [
        'user' => $user->id
    ])->assertRedirect(route('courses.manage.groups.show', [$this->course, $this->group]))
        ->assertSessionHas('success', 'User removed');

    assertDatabaseMissing('group_user', [
        'group_id' => $this->group->id,
        'user_id'  => $user->id,
    ]);
});

it('renames a group', function() {
    put(route('courses.manage.groups.update', [$this->course, $this->group]), [
        'name' => 'Renamed Group'
    ])->assertRedirect(route('courses.manage.groups.show', [$this->course, $this->group]))
        ->assertSessionHas('success', 'Group renamed');

    assertDatabaseHas('groups', [
        'id'   => $this->group->id,
        'name' => 'Renamed Group'
    ]);
});

it('sets the max group size to 2', function() {
    put(route('courses.manage.groups.update-settings', $this->course), [
        'max-group-size' => 2
    ])->assertRedirect(route('courses.manage.groups.index', $this->course))
        ->assertSessionHas('success', 'Max group size set to 2');

    assertDatabaseHas('courses', [
        'id'             => $this->course->id,
        'max_group_size' => 2
    ]);
});

it('sets the allowed number of groups to same as assignments', function() {
    put(route('courses.manage.groups.update-settings', $this->course), [
        'max-groups' => 'same_as_assignments'
    ])->assertRedirect(route('courses.manage.groups.index', $this->course))
        ->assertSessionHas('success', 'Each student can now be part of one group per assignment');

    assertDatabaseHas('courses', [
        'id'         => $this->course->id,
        'max_groups' => 'same_as_assignments'
    ]);
});

it('sets the allowed number of groups to 3', function() {
    put(route('courses.manage.groups.update-settings', $this->course), [
        'max-groups'        => 'custom',
        'max-groups-amount' => 3
    ])->assertRedirect(route('courses.manage.groups.index', $this->course))
        ->assertSessionHas('success', 'Each student can now be part of 3 group(s)');

    assertDatabaseHas('courses', [
        'id'                => $this->course->id,
        'max_groups'        => 'custom',
        'max_groups_amount' => 3
    ]);
});

it('sets the allowed number of groups to none', function() {
    put(route('courses.manage.groups.update-settings', $this->course), [
        'max-groups' => 'none'
    ])->assertRedirect(route('courses.manage.groups.index', $this->course))
        ->assertSessionHas('success', 'Students can no longer form groups');

    assertDatabaseHas('courses', [
        'id'         => $this->course->id,
        'max_groups' => 'none'
    ]);
});
