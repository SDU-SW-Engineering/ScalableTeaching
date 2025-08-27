<?php

namespace Tests\Feature\Course;

use App\Jobs\Course\AddMemberToCourseGroup;
use App\Jobs\Course\UpdateTeachersAccessToCourseGitlabGroup;
use App\Models\Course;
use App\Models\User;
use Domain\GitLab\Definitions\GitLabUserAccessLevelEnum;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Queue;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

it('allows admins to create courses', function () {
    $admin = User::factory()->admin()->create();
    actingAs($admin);
    Queue::fake();

    $mockManager = generateMockedGitlabManager();

    $this->app->instance(GitLabManager::class, $mockManager);

    $this->followingRedirects()->post('/courses', [
        'course-name' => 'ScalableTeachingAutomatedTestCourse',
    ])->assertStatus(200)->assertSee('ScalableTeachingAutomatedTestCourse');

    $this->assertDatabaseHas('courses', [
        'name' => 'ScalableTeachingAutomatedTestCourse',
        'gitlab_group_id' => 123,
        'teacher_access_to_gitlab_group' => false,
    ]);
});

it('does not attempt to add teachers to gitlab group when not selected', function () {
    $admin = User::factory()->admin()->create();
    actingAs($admin);
    Queue::fake();

    $mockManager = generateMockedGitlabManager();

    $this->app->instance(GitLabManager::class, $mockManager);

    $this->followingRedirects()->post('/courses', [
        'course-name' => 'ScalableTeachingAutomatedTestCourse',
    ])->assertStatus(200)->assertSee('ScalableTeachingAutomatedTestCourse');

    $this->assertDatabaseHas('courses', [
        'name' => 'ScalableTeachingAutomatedTestCourse',
        'gitlab_group_id' => 123,
        'teacher_access_to_gitlab_group' => false,
    ]);

    Queue::assertNothingPushed();
});

it('attempts to teachers to gitlab group when selected', function () {
    $admin = User::factory()->admin()->create();
    actingAs($admin);
    Queue::fake();

    $mockManager = generateMockedGitlabManager();

    $this->app->instance(GitLabManager::class, $mockManager);

    $this->followingRedirects()->post('/courses', [
        'course-name' => 'ScalableTeachingAutomatedTestCourse',
        'access-to-gitlab-group' => '1',
    ])->assertStatus(200)->assertSee('ScalableTeachingAutomatedTestCourse');

    $this->assertDatabaseHas('courses', [
        'name' => 'ScalableTeachingAutomatedTestCourse',
        'gitlab_group_id' => 123,
        'teacher_access_to_gitlab_group' => true,
    ]);

    Queue::assertPushed(AddMemberToCourseGroup::class, function ($job) use ($admin) {
        return $job->gitlabUser === $admin->gitlab_id &&
            $job->groupId === 123 &&
            $job->level === GitLabUserAccessLevelEnum::OWNER->value;
    });
});

it('attempts to add teacher to the gitlab group', function () {
    $admin = User::factory()->admin()->create();
    actingAs($admin);
    Queue::fake();

    /**
     * @var $course Course
     */
    $course = Course::factory()->create([
        'name'=>'ScalableTeachingAutomatedTestCourse',
        'gitlab_group_id' => 123,
        'teacher_access_to_gitlab_group' => false,
    ]);

    $course->teachers()->attach($admin);

    $this->post(route('courses.toggleTeacherGitlabAccess', [$course]), [])->assertSessionHas('success-task', 'The access was updated.');
    $course->refresh();
    Queue::assertPushed(UpdateTeachersAccessToCourseGitlabGroup::class, function ($job) use ($course) {
        return $job->course->id == $course->id;
    });
    $this->assertTrue((bool) $course->teacher_access_to_gitlab_group);
});

it('attempts to remove teacher to the gitlab group', function () {
    $admin = User::factory()->admin()->create();
    actingAs($admin);
    Queue::fake();

    /**
     * @var $course Course
     */
    $course = Course::factory()->create([
        'name'=>'ScalableTeachingAutomatedTestCourse',
        'gitlab_group_id' => 123,
        'teacher_access_to_gitlab_group' => true,
    ]);

    $course->teachers()->attach($admin);

    $this->post(route('courses.toggleTeacherGitlabAccess', [$course]), [])->assertSessionHas('success-task', 'The access was updated.');
    $course->refresh();
    Queue::assertPushed(UpdateTeachersAccessToCourseGitlabGroup::class, function ($job) use ($course) {
        return $job->course->id == $course->id;
    });
    $this->assertFalse((bool) $course->teacher_access_to_gitlab_group);
});


it('verifies that the name field is filled during course creation', function () {
    $admin = User::factory()->admin()->create();
    actingAs($admin);

    $response = $this->post('/courses');

    $response->assertSessionHasErrors(['course-name']);
});


/**
 * @return GitLabManager
 */
function generateMockedGitlabManager(): GitLabManager
{
// Mock the GitLabManager
    $mockManager = Mockery::mock(GitLabManager::class);

    $mockGroups = Mockery::mock();
    $mockGroups->shouldReceive('subgroups')
        ->with(config('scalable.gitlab_group'), ['search' => 'scalableteachingautomatedtestcourse'])
        ->andReturn([]);

    $mockManager->shouldReceive('groups')->andReturn($mockGroups);

    $mockResponseBody = Mockery::mock();
    $mockResponseBody->shouldReceive('getContents')
        ->andReturn(json_encode(['id' => 123]));

    $mockResponse = Mockery::mock();
    $mockResponse->shouldReceive('getStatusCode')->andReturn(201);
    $mockResponse->shouldReceive('getBody')->andReturn($mockResponseBody);

    $mockHttpClient = Mockery::mock();
    $mockHttpClient->shouldReceive('post')
        ->with('api/v4/groups', ['Content-type' => 'application/json'], Mockery::any())
        ->andReturn($mockResponse);

    $mockManager->shouldReceive('getHttpClient')->andReturn($mockHttpClient);
    return $mockManager;
}
