<?php

use App\Models\Course;
use App\Models\Enums\GradeEnum;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\ProjectStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->course = Course::factory()->create();
    $this->task = Task::factory()->for($this->course)->create();
    $this->user = User::factory()->hasAttached($this->course)->create();
    $this->group = Group::factory()->for($this->course)
        ->has(User::factory()->count(2)->hasAttached($this->course), 'members')->create();
    $this->courseResponsible = User::factory()->hasAttached($this->course, ['role' => 'teacher'])->create();

    $this->project = Project::factory()
        ->for($this->task)
        ->for($this->user, 'ownable')
        ->createQuietly();
    $this->groupProject = Project::factory()
        ->for($this->task)
        ->for($this->group, 'ownable')
        ->createQuietly();
});

it('fails a user when a project is marked as overdue', function() {

    $this->project->setProjectStatus(ProjectStatus::Overdue);

    expect(Grade::firstWhere([
        'user_id'  => $this->user->id,
        'task_id'  => $this->task->id,
        'selected' => true,
    ])->value)->toBe(GradeEnum::Failed);
});

it('passes a user when a project is marked as finished', function() {

    $this->project->setProjectStatus(ProjectStatus::Finished);

    expect(Grade::firstWhere([
        'user_id'  => $this->user->id,
        'task_id'  => $this->task->id,
        'selected' => true,
    ])->value)->toBe(GradeEnum::Passed);
});

it('passes both users when a group project is finished', function() {
    $this->groupProject->setProjectStatus(ProjectStatus::Finished);

    expect(Grade::whereIn('user_id', $this->group->members->pluck('id'))
        ->where('task_id', $this->task->id)
        ->where('selected', true)
        ->pluck('value')->toArray())->toBe([GradeEnum::Passed, GradeEnum::Passed]);
});

it('fails both users when a group project is overdue', function() {
    $this->groupProject->setProjectStatus(ProjectStatus::Overdue);

    expect(Grade::whereIn('user_id', $this->group->members->pluck('id'))
        ->where('task_id', $this->task->id)
        ->where('selected', true)
        ->pluck('value')->toArray())->toBe([GradeEnum::Failed, GradeEnum::Failed]);
});

it('disallows students to access grades', function() {
    actingAs($this->user);
    get(route('courses.manage.grading.index', $this->course->id))->assertStatus(403);

    $grade = Grade::factory([
        'source_type' => Task::class,
        'source_id'   => $this->task->id,
    ])->for($this->user)->for($this->task)->create();
    post(route('courses.manage.grading.set-selected', [$this->course->id, $grade->id]))->assertStatus(403);
    get(route('courses.manage.grading.task-info', [$this->course->id, $this->task->id]))->assertStatus(403);
    put(route('courses.manage.grading.updateGrading', [$this->course->id, $this->user->id]))->assertStatus(403);
});

it('allows course responsible to access grades', function() {
    actingAs($this->courseResponsible);
    get(route('courses.manage.grading.index', $this->course->id))->assertStatus(200);

    $grade = Grade::factory([
        'source_type' => Task::class,
        'source_id'   => $this->task->id,
    ])->for($this->user)->for($this->task)->create();
    post(route('courses.manage.grading.set-selected', [$this->course->id, $grade->id]))->assertStatus(200);
    get(route('courses.manage.grading.task-info', [$this->course->id, $this->task->id]))->assertStatus(200);
    put(route('courses.manage.grading.updateGrading', [$this->course->id, $this->user->id]), [
        'grade'  => 'passed',
        'taskId' => $this->task->id,
    ])->assertStatus(200);
});

it('selects the new grade as the current one', function() {
    $grade1 = Grade::factory([
        'source_type' => Task::class,
        'source_id'   => $this->task->id,
    ])->for($this->user)->for($this->task)->create();
    $grade2 = Grade::factory([
        'source_type' => Task::class,
        'source_id'   => $this->task->id,
    ])->for($this->user)->for($this->task)->create();

    $grade1->refresh();
    expect($grade1->selected)->toBeFalse()
        ->and($grade2->selected)->toBeTrue();
});

it('does not select a new grade if the current one is created by a user', function() {
    $grade1 = Grade::factory([
        'source_type' => User::class,
        'source_id'   => $this->courseResponsible->id,
    ])->for($this->user)->for($this->task)->create();
    $grade2 = Grade::factory([
        'source_type' => Task::class,
        'source_id'   => $this->task->id,
    ])->for($this->user)->for($this->task)->create();

    $grade1->refresh();
    expect($grade1->selected)->toBeTrue()
        ->and($grade2->selected)->toBeFalse();
});

it('changes the selected grade from a history of grades', function() {
    actingAs($this->courseResponsible);
    $grade1 = Grade::factory([
        'source_type' => Task::class,
        'source_id'   => $this->task->id,
    ])->for($this->user)->for($this->task)->create();
    $grade2 = Grade::factory([
        'source_type' => Task::class,
        'source_id'   => $this->task->id,
    ])->for($this->user)->for($this->task)->create();

    post(route('courses.manage.grading.set-selected', [$this->course->id, $grade1->id]))->assertStatus(200);
    $grade1->refresh();
    $grade2->refresh();

    expect($grade1->selected)->toBeTrue()
        ->and($grade2->selected)->toBeFalse();
});

it('creates a new grade', function() {
    expect(Grade::count())->toBe(0);
    actingAs($this->courseResponsible);
    put(route('courses.manage.grading.updateGrading', [$this->course->id, $this->user->id]), [
        'grade'  => 'passed',
        'taskId' => $this->task->id,
    ]);
    expect(Grade::count())->toBe(1);
    $grade = Grade::where('user_id', $this->user->id)->where('task_id', $this->task->id)->first();

    expect($grade->value)->toBe(GradeEnum::Passed);
});
