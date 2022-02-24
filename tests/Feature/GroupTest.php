<?php

use App\Models\Course;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDeleted;
use function Pest\Laravel\assertModelExists;
use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\post;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

beforeEach(function ()
{
    $this->course = Course::factory([
        'max_groups'        => 'custom',
        'max_groups_amount' => 3,
        'max_group_size'    => 5
    ])->create();
    $this->group  = Group::factory()->for($this->course)->create();
    $this->user   = User::factory()->hasAttached($this->course)->create();
    $this->user->groups()->attach($this->group);
    $this->user2 = User::factory()->hasAttached($this->course)->create();
});

it('allows students to create groups', function ()
{
    actingAs($this->user);
    postJson(route('courses.groups.create', $this->course), [
        'name' => 'My Group'
    ])->assertStatus(422);

    postJson(route('courses.groups.create', $this->course), [
        'name' => 'my-group'
    ])->assertStatus(201);

    expect($this->course->groups()->where('name', 'my-group')->exists())->toBeTrue();
});

it('rejects new groups when the "same as assignment" option is set and triggered', function ()
{
    actingAs($this->user);
    $this->course->update(['max_groups_amount' => 1]);
    postJson(route('courses.groups.create', $this->course), [
        'name' => 'my-group'
    ])->assertStatus(403);
});

it('rejects new groups when the "custom" option is set and threshold is reached', function ()
{
    actingAs($this->user);
    $this->course->update(['max_groups_amount' => 2]);
    postJson(route('courses.groups.create', $this->course), [
        'name' => 'my-group'
    ])->assertStatus(201);
    postJson(route('courses.groups.create', $this->course), [
        'name' => 'my-group'
    ])->assertStatus(403);
});

it('rejects new groups when the "none" option is set', function ()
{
    actingAs($this->user);
    $this->course->update(['max_groups' => 'none']);
    postJson(route('courses.groups.create', $this->course), [
        'name' => 'my-group'
    ])->assertStatus(403);
});

it('rejects groups with the same name', function ()
{
    actingAs($this->user);
    postJson(route('courses.groups.create', $this->course), [
        'name' => 'my-group'
    ])->assertStatus(201);
    postJson(route('courses.groups.create', $this->course), [
        'name' => 'my-group'
    ])->assertStatus(422);
});

it('allows students to invite other students', function ()
{
    actingAs($this->user);

    expect($this->group->hasMember($this->user2))->toBeFalse();
    expect($this->group->invitations->firstWhere('recipient_user_id', $this->user2->id))->toBeNull();

    postJson(route('courses.groups.invite', [$this->course, $this->group]), [
        'email' => $this->user2->email
    ])->assertStatus(201);

    $this->group->refresh();
    expect($this->group->invitations->firstWhere('recipient_user_id', $this->user2->id))->not()->toBeNull();
});

it('disallows students to invite themselves', function ()
{
    actingAs($this->user);

    postJson(route('courses.groups.invite', [$this->course, $this->group]), [
        'email' => $this->user->email
    ])->assertStatus(422);
});

it('allows students to accepts invites', function ()
{
    $groupInvitation = $this->group->invitations()->create([
        'recipient_user_id'  => $this->user2->id,
        'invited_by_user_id' => $this->user->id
    ]);

    expect($this->group->hasMember($this->user2))->toBeFalse();
    actingAs($this->user2);
    getJson(route('courses.groups.respondInvite', [$this->course, $this->group, $groupInvitation, 'accept']))->assertStatus(200);
    expect($this->group->hasMember($this->user2))->toBeTrue();
    assertModelMissing($groupInvitation);
});

it('allows students to decline invites', function ()
{
    $groupInvitation = $this->group->invitations()->create([
        'recipient_user_id'  => $this->user2->id,
        'invited_by_user_id' => $this->user->id
    ]);

    expect($this->group->hasMember($this->user2))->toBeFalse();
    actingAs($this->user2);
    getJson(route('courses.groups.respondInvite', [$this->course, $this->group, $groupInvitation, 'decline']))->assertStatus(200);
    expect($this->group->hasMember($this->user2))->toBeFalse();
    assertModelMissing($groupInvitation);
});

it('allows students to leave groups', function ()
{
    $this->group->users()->attach($this->user2);
    actingAs($this->user2);

    postJson(route('courses.groups.leave', [$this->course, $this->group]))->assertStatus(200);
    expect($this->group->hasMember($this->user2))->toBeFalse();
});

it('prohibits students from leaving groups they are not member of', function ()
{
    actingAs($this->user2);

    postJson(route('courses.groups.leave', [$this->course, $this->group]))->assertStatus(403);
    expect($this->group->hasMember($this->user2))->toBeFalse();
});

it('allows the group owner to delete groups', function ()
{
    $this->group->users()->updateExistingPivot($this->user->id, [
        'is_owner' => true
    ]);
    actingAs($this->user);
    deleteJson(route('courses.groups.destroy', [$this->course, $this->group]))->assertStatus(200);
    assertModelMissing($this->group);
});

it('prohibits deletion of a group by non-owners', function ()
{
    $this->group->users()->attach($this->user2);
    actingAs($this->user2);

    deleteJson(route('courses.groups.destroy', [$this->course, $this->group]))->assertStatus(403);
    assertModelExists($this->group);
});

it('only allows members of the same course to be invited', function ()
{
    $this->group->users()->attach($this->user2);
    actingAs($this->user2);
    $newUser = User::factory()->create();

    postJson(route('courses.groups.invite', [$this->course, $this->group]), [
        'email' => $newUser->email
    ])->assertStatus(422);
});

it('allows group members to withdraw invites', function ()
{
    actingAs($this->user);
    $groupInvitation = $this->group->invitations()->create([
        'recipient_user_id'  => User::factory()->create()->id,
        'invited_by_user_id' => $this->user->id
    ]);
    deleteJson(route('courses.groups.invitations.delete', [$this->course, $this->group, $groupInvitation]))->assertStatus(200);
    assertModelMissing($groupInvitation);
});

it('prohibits non-members from withdrawing invities', function ()
{
    actingAs($this->user2);
    $groupInvitation = $this->group->invitations()->create([
        'recipient_user_id'  => User::factory()->create()->id,
        'invited_by_user_id' => $this->user->id
    ]);
    deleteJson(route('courses.groups.invitations.delete', [$this->course, $this->group, $groupInvitation]))->assertStatus(403);
    assertModelExists($groupInvitation);
});

it('prohibits students from joining an already full group', function ()
{
    $this->course->update(['max_group_size' => 1]);
    $groupInvitation = $this->group->invitations()->create([
        'recipient_user_id'  => $this->user2->id,
        'invited_by_user_id' => $this->user->id
    ]);
    actingAs($this->user2);
    getJson(route('courses.groups.respondInvite', [$this->course, $this->group, $groupInvitation, 'accept']))->assertStatus(422);
    expect($this->group->hasMember($this->user2))->toBeFalse();
    assertModelExists($groupInvitation);
});

it('prohibits students from joining a group that is working on a project that the student has already begun', function ()
{
    $task            = Task::factory()->for($this->course)->create();
    $groupInvitation = $this->group->invitations()->create([
        'recipient_user_id'  => $this->user2->id,
        'invited_by_user_id' => $this->user->id
    ]);

    Project::factory()->for($this->user2, 'ownable')->for($task)->createQuietly();
    Project::factory()->for($this->group, 'ownable')->for($task)->createQuietly();
    actingAs($this->user2);

    getJson(route('courses.groups.respondInvite', [$this->course, $this->group, $groupInvitation, 'accept']))->assertStatus(422);
});
