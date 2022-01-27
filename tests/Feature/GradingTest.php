<?php

use App\Models\Course;
use App\Models\Enums\GradeEnum;
use App\Models\Grade;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\ProjectStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function(){
    $this->user = User::factory()->create();
    $this->task = Task::factory()->for(Course::factory())->create();

    $this->project = Project::factory()
        ->for($this->task)
        ->for($this->user, 'ownable')
        ->create();

});

it('fails a user when a project is marked as overdue', function() {

    $this->project->update([
        'status' => ProjectStatus::Overdue
    ]);

    expect(Grade::firstWhere([
        'user_id'  => $this->user->id,
        'task_id'  => $this->task->id,
        'selected' => true
    ])->value)->toBe(GradeEnum::Failed);
});

it('passes a user when a project is marked as finished', function() {

    $this->project->update([
        'status' => ProjectStatus::Finished
    ]);

    expect(Grade::firstWhere([
        'user_id'  => $this->user->id,
        'task_id'  => $this->task->id,
        'selected' => true
    ])->value)->toBe(GradeEnum::Passed);
});

