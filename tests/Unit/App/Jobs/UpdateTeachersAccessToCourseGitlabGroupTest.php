<?php

use App\Jobs\Course\UpdateTeachersAccessToCourseGitlabGroup;
use App\Models\Course;
use App\Models\User;
use Domain\GitLab\Definitions\GitLabUserAccessLevelEnum;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->course = Course::factory()->create();
    $this->admin = User::factory()->admin()->create();
    $this->course->teachers()->attach($this->admin, ['role' => 'teacher']);

});

it('should attempt to add teacher from the Gitlab group', function () {
    $job = new UpdateTeachersAccessToCourseGitlabGroup($this->course);

    $this->course->teacher_access_to_gitlab_group = true;
    $this->course->save();

    $mockManager = Mockery::mock(GitLabManager::class);
    $groupsMock = Mockery::mock();
    $mockManager->shouldReceive('groups')->withNoArgs()->once()->andReturn($groupsMock);
    $groupsMock->shouldReceive('addMember')->with($this->course->gitlab_group_id, $this->admin->gitlab_id, GitLabUserAccessLevelEnum::OWNER->value)->once();


    $this->app->instance(GitLabManager::class, $mockManager);
    $job->handle();
});

it('should attempt to remove teacher from the Gitlab group', function () {
    $job = new UpdateTeachersAccessToCourseGitlabGroup($this->course);

    $this->course->teacher_access_to_gitlab_group = false;
    $this->course->save();

    $mockManager = Mockery::mock(GitLabManager::class);
    $groupsMock = Mockery::mock();
    $mockManager->shouldReceive('groups')->withNoArgs()->once()->andReturn($groupsMock);
    $groupsMock->shouldReceive('removeMember')->with($this->course->gitlab_group_id, $this->admin->gitlab_id)->once();


    $this->app->instance(GitLabManager::class, $mockManager);
    $job->handle();
});
