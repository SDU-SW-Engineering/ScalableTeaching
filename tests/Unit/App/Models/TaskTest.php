<?php

namespace Tests\Models;

use App\Models\Course;
use App\Models\Group;
use App\Models\Task;
use App\Models\User;
use App\Modules\LinkRepository\LinkRepository;
use App\Modules\LinkRepository\LinkRepositorySettings;
use Carbon\Carbon;
use Gitlab\Api\Projects;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Mockery;
use Tests\TestCase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->course = Course::factory()->create();
    $this->task = Task::factory()->for($this->course)->create();
    $this->user = User::factory()->hasAttached($this->course)->create();
});

it('returns null if LinkRepository module is not enabled', function () {
    expect($this->task->getGitlabProjectId())->toBeNull();
});

it('returns the correct ID of the gitlab project', function () {
    addLinkToRepositoryModule($this);

    expect($this->task->getGitlabProjectId())->toBe(9033);
});

it('adds single user to template repository if task is a "code task"', function () {
    addLinkToRepositoryModule($this);
    expect($this->task->isCodeTask())->toBeTrue();

    $user = User::factory()->create();

    // Mock GitLabManager & Projects
    $mockGitLabManager = Mockery::mock(GitLabManager::class);
    $mockProjects = Mockery::mock(Projects::class);

    // Ensure that `projects()` method returns the mock
    $mockGitLabManager->shouldReceive('projects')
        ->andReturn($mockProjects);

    // Mock `addMember` before execution
    $mockProjects->shouldReceive('addMember')
        ->with('9033', $user->gitlab_id, 20)
        ->once()
        ->andReturnNull();


    $mockProjects->shouldReceive('allMembers')
        ->with('9033')
        ->once()
        ->andReturn([[]]);  // Prevent actual execution

    // Make Laravel use the mocked instance
    app()->instance(GitLabManager::class, $mockGitLabManager);

    // Act
    $this->task->createProject($user);
    assertDatabaseHas('projects', [
        'task_id'              => $this->task->id,
        'ownable_type'         => 'App\Models\User',
        'ownable_id'           => $user->id,
    ]);
});

it('does not add user to template repository if the user is already a member', function () {
    addLinkToRepositoryModule($this);
    expect($this->task->isCodeTask())->toBeTrue();

    $user = User::factory()->create();

    // Mock GitLabManager & Projects
    $mockGitLabManager = Mockery::mock(GitLabManager::class);
    $mockProjects = Mockery::mock(Projects::class);

    // Ensure that `projects()` method returns the mock
    $mockGitLabManager->shouldReceive('projects')
        ->andReturn($mockProjects);

    $mockProjects->shouldReceive('allMembers')
        ->with('9033')
        ->once()
        ->andReturn([['id' => $user->gitlab_id]]);

    // Mock `addMember` before execution
    $mockProjects->shouldReceive('addMember')
        ->with('9033', $user->gitlab_id, 20)
        ->never()
        ->andReturnNull();


    // Make Laravel use the mocked instance
    app()->instance(GitLabManager::class, $mockGitLabManager);

    // Act
    $this->task->createProject($user);
    assertDatabaseHas('projects', [
        'task_id'              => $this->task->id,
        'ownable_type'         => 'App\Models\User',
        'ownable_id'           => $user->id,
    ]);
});

it('adds all users of a group to template repository if task is a "code task"', function () {
    addLinkToRepositoryModule($this);
    expect($this->task->isCodeTask())->toBeTrue();
    $group = Group::factory([
        'name'      => 'Example Group',
    ])->for($this->course)->create();

    // Create four users
    $users = User::factory()->count(4)->create();

    // Attach users to the group
    $group->members()->attach($users);

    // Mock GitLabManager & Projects
    $mockGitLabManager = Mockery::mock(GitLabManager::class);
    $mockProjects = Mockery::mock(Projects::class);

    // Ensure that `projects()` method returns the mock
    $mockGitLabManager->shouldReceive('projects')
        ->andReturn($mockProjects);

    // Mock `addMember` before execution
    $mockProjects->shouldReceive('addMember')
        ->with('9033', Mockery::any(), 20)
        ->times(4)
        ->andReturnNull();  // Prevent actual execution

    $mockProjects->shouldReceive('allMembers')
        ->with('9033')
        ->times(4)
        ->andReturn([[]]);  // Prevent actual execution


    // Make Laravel use the mocked instance
    app()->instance(GitLabManager::class, $mockGitLabManager);

    // Act
    $this->task->createProject($group);

    assertDatabaseHas('projects', [
        'task_id'              => $this->task->id,
        'ownable_type'         => 'App\Models\Group',
        'ownable_id'           => $group->id,
    ]);
});

it('only adds members of a group if they are not already a member of the template repository', function () {
    addLinkToRepositoryModule($this);
    expect($this->task->isCodeTask())->toBeTrue();
    $group = Group::factory([
        'name'      => 'Example Group',
    ])->for($this->course)->create();

    // Create four users
    $users = User::factory()->count(4)->create();

    // Attach users to the group
    $group->members()->attach($users);

    // Mock GitLabManager & Projects
    $mockGitLabManager = Mockery::mock(GitLabManager::class);
    $mockProjects = Mockery::mock(Projects::class);

    // Ensure that `projects()` method returns the mock
    $mockGitLabManager->shouldReceive('projects')
        ->andReturn($mockProjects);

    // Mock `addMember` before execution
    $mockProjects->shouldReceive('addMember')
        ->with('9033', Mockery::any(), 20)
        ->times(3)
        ->andReturnNull();

    $mockProjects->shouldReceive('allMembers')
        ->with('9033')
        ->times(4)
        ->andReturn([['id' => $group->members()->first()->gitlab_id]]);


    // Make Laravel use the mocked instance
    app()->instance(GitLabManager::class, $mockGitLabManager);

    // Act
    $this->task->createProject($group);

    assertDatabaseHas('projects', [
        'task_id'              => $this->task->id,
        'ownable_type'         => 'App\Models\Group',
        'ownable_id'           => $group->id,
    ]);
});

/**
 * @param \PHPUnit\Framework\TestCase $that
 * @return void
 */
function addLinkToRepositoryModule(\PHPUnit\Framework\TestCase $that): void
{
    $that->task->module_configuration->addModule(LinkRepository::class);
    $settings = new LinkRepositorySettings();
    $settings->repo = "id://gitlab/Project/9033";
    $that->task->module_configuration->update(LinkRepository::class, $settings, $that->task);
    $that->task->module_configuration->resolveModule(LinkRepository::class)->update($that->task);
}
