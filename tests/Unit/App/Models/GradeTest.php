<?php

use App\Models\Course;
use App\Models\CourseActivity;
use App\Models\Grade;
use App\Models\ProjectFeedback;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->course = Course::factory()->create();
    $this->user = User::factory()->hasAttached($this->course)->create();
    $this->task = Task::factory()->for($this->course)->create();
});

it("logs when grades are created", function() {
    $grade = Grade::factory()->passed()->for($this->user)->for($this->task)->for($this->user, 'source')->create();

    assertDatabaseHas('course_activities', [
        'course_id'      => $this->course->id,
        'affected_id'    => $this->user->id,
        'affected_by_id' => $this->user->id,
        'resource_id'    => $grade->id,
        'resource_type'  => Grade::class,
    ]);

    expect(CourseActivity::first()->message)->toContain('Passed', 'self grading');
});

it("logs when non-user grades are created.", function() {
    $grade = Grade::factory()->failed()->for($this->user)->for($this->task)->for($this->task, 'source')->create();

    assertDatabaseHas('course_activities', [
        'course_id'      => $this->course->id,
        'affected_id'    => $this->user->id,
        'affected_by_id' => null,
        'resource_id'    => $grade->id,
        'resource_type'  => Grade::class,
    ]);

    expect(CourseActivity::first()->message)->toContain('Failed', 'graded by system');
});

it("logs when a user is graded through a grade delegation", function() {
    $project = Project::factory()
        ->for($this->task)
        ->createQuietly();
    $secondUser = User::factory()->hasAttached($this->course)->create();

    $gradeDelegation = ProjectFeedback::factory()
        ->for($project)
        ->for($secondUser)->create();

    $grade = Grade::factory()->passed()->for($this->user)->for($this->task)->for($this->task, 'source')->create([
        'source_type' => ProjectFeedback::class,
        'source_id'   => $gradeDelegation->id,
    ]);

    assertDatabaseHas('course_activities', [
        'course_id'      => $this->course->id,
        'affected_id'    => $this->user->id,
        'affected_by_id' => $secondUser->id,
        'resource_id'    => $grade->id,
        'resource_type'  => Grade::class,
    ]);

    expect(CourseActivity::first()->message)
        ->toContain('Passed')
        ->not()->toContain('graded by system')
        ->not()->toContain('self grading');
});

