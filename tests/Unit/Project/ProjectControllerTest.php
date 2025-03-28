<?php

use App\Events\ProjectDeleting;
use App\Http\Controllers\ProjectController;
use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Modules\LinkRepository\LinkRepository;
use App\Modules\LinkRepository\LinkRepositorySettings;
use App\Modules\Module;
use App\Modules\ModuleConfiguration;
use App\Modules\Settings;
use App\Modules\Template\Template;
use App\ProjectStatus;
use Carbon\Carbon;
use Gitlab\Api\Projects;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpKernel\Exception\HttpException;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\instance;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->project = Project::factory(['status' => ProjectStatus::Active])
        ->for(Task::factory(['sub_tasks' => [
            new SubTask('11 Equals [10, 1]', 'test 11 equals [10, 1]'),
            new SubTask('9 Equals [5,2,2]', 'test 9 equals [5,2,2]'),
            new SubTask('2 Equals [2]', 'test 2 equals [2]'),
        ],
        'module_configuration' => new ModuleConfiguration()])
        ->for(Course::factory()))->createQuietly();

    $this->gitLabManager = mockery::mock(GitLabManager::class);
    $this->projectController = new ProjectController();
    $this->mockProjects = Mockery::mock(Projects::class);

    $this->gitLabManager->shouldReceive('projects')
        ->andReturn($this->mockProjects);
    instance(GitLabManager::class, $this->gitLabManager);
});

it('does not attempt to reset a project that is finished', function () {
    $this->project->status = ProjectStatus::Finished;
    $this->project->save();

    expect(fn () => $this->projectController->reset($this->project))->toThrow(HttpException::class);
});

it('does not attempt to reset a project that is over due', function () {
    $this->project->task()->ends_at = Carbon::now()->subDay();
    $this->project->status = ProjectStatus::Overdue;
    $this->project->save();
    expect(fn () => $this->projectController->reset($this->project))->toThrow(HttpException::class);
});

it('deletes the project; No modules installed on task', function () {
    $this->projectController->reset($this->project);

    assertDatabaseMissing('projects', ['id' => $this->project->id, 'deleted_at' => null]);
});

it('also deletes grades', function () {
    $user = User::factory()->create();
    $user2 = User::factory()->create();
    auth()->login($user);

    $grade = Grade::factory([
        'user_id'     => $user2->id,
        'source_type' => User::class,
        'source_id'   => $user->id,
    ])->for($this->project->task)->create();

    $this->projectController->reset($this->project);

    assertDatabaseMissing('projects', ['id' => $this->project->id, 'deleted_at' => null]);
    assertDatabaseMissing('grades', ['id' => $grade->id]);
});

it('removes (user) project owner from template repository and deletes the project', function () {
    $this->installLinkRepositoryModule($this->project->task, "id://gitlab/Project/9033");
    $user = User::factory()->create();
    //Disable all events to prevent unintented interactions with mocked GitLabManager (Except for ProjectDeleting event which is needed for proper deletion)
    Event::fakeExcept(ProjectDeleting::class);
    $this->project->claim($user);

    $this->mockProjects->shouldReceive('removeMember')
        ->with(9033, $user->gitlab_id)
        ->once()
        ->andReturnNull();

    $this->projectController->reset($this->project);

    assertDatabaseMissing('projects', ['id' => $this->project->id, 'deleted_at' => null]);
});

it('removes (group) project owner(s) from template repository and deletes the project', function () {
    $this->installLinkRepositoryModule($this->project->task, "id://gitlab/Project/9033");
    $group = Group::factory()->create(['course_id' => $this->project->task->course->id]);
    $group->members()->attach(User::factory()->count(3)->create());
    //Disable all events to prevent unintented interactions with mocked GitLabManager (Except for ProjectDeleting event which is needed for proper deletion)
    Event::fakeExcept(ProjectDeleting::class);
    $this->project->claim($group);

    $this->mockProjects->shouldReceive('removeMember')
        ->with(9033, Mockery::any())
        ->times(3)
        ->andReturnNull();

    $this->projectController->reset($this->project);

    assertDatabaseMissing('projects', ['id' => $this->project->id, 'deleted_at' => null]);
});

it('deletes repository and deletes the project if task is templateTask', function () {
    $this->installLinkRepositoryModule($this->project->task, "id://gitlab/Project/9033");
    $this->installTemplateModule($this->project->task);
    $user = User::factory()->create();
    //Disable all events to prevent unintended interactions with mocked GitLabManager (Except for ProjectDeleting event which is needed for proper deletion)
    Event::fakeExcept(ProjectDeleting::class);
    $this->project->claim($user);
    $this->project->gitlab_project_id = 1234;
    $this->project->save();

    $this->mockProjects->shouldReceive('remove')
        ->with(1234)
        ->once()
        ->andReturnNull();

    $this->projectController->reset($this->project);

    assertDatabaseMissing('projects', ['id' => $this->project->id, 'deleted_at' => null]);
});
