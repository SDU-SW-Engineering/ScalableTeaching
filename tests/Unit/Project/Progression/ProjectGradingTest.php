<?php

use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Group;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->project = Project::factory()->for(Task::factory([
        'correction_type' => CorrectionType::AllTasks,
        'sub_tasks'       => [
            new SubTask('11 Equals [10, 1]', 'test 11 equals [10, 1]'),
            new SubTask('9 Equals [5,2,2]', 'test 9 equals [5,2,2]'),
            new SubTask('2 Equals [2]', 'test 2 equals [2]'),
        ],
    ])->for(Course::factory()))->createQuietly();
});

it('ensures a finished project creates gradings', function() {
    /** @var User $user */
    $user = User::factory()->create();
    $user->projects()->save($this->project);

    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ],
    ]);
    $this->project->refresh();

    assertDatabaseCount('grades', 1);
    assertDatabaseHas('grades', [
        'user_id'     => $user->id,
        'task_id'     => $this->project->task_id,
        'source_type' => Project::class,
        'source_id'   => $this->project->id,
    ]);
})->skip('Skipped until AutomaticGradingType all subtasks is implemented');

it('ensures a finished project creates gradings for group members', function() {
    $group = Group::factory()->create([
        'course_id' => $this->project->task->course_id,
    ]);
    /** @var User $user */
    $users = User::factory(2)->create();
    $group->members()->attach($users);
    $group->projects()->save($this->project);

    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ],
    ]);
    $this->project->refresh();

    assertDatabaseCount('grades', 2);
    assertDatabaseHas('grades', [
        'user_id'     => $users[0]->id,
        'task_id'     => $this->project->task_id,
        'source_type' => Project::class,
        'source_id'   => $this->project->id,
    ]);
    assertDatabaseHas('grades', [
        'user_id'     => $users[1]->id,
        'task_id'     => $this->project->task_id,
        'source_type' => Project::class,
        'source_id'   => $this->project->id,
    ]);
})->skip('Skipped until AutomaticGradingType all subtasks is implemented');

it('ensures a finished project can\'t be graded twice', function() {
    /** @var User $user */
    $user = User::factory()->create();
    $user->projects()->save($this->project);

    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ],
    ]);
    $this->project->refresh();

    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ],
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ],
    ]);

    assertDatabaseCount('grades', 1);
    assertDatabaseHas('grades', [
        'user_id'     => $user->id,
        'task_id'     => $this->project->task_id,
        'source_type' => Project::class,
        'source_id'   => $this->project->id,
    ]);
})->skip('Skipped until AutomaticGradingType all subtasks is implemented');
