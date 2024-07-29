<?php

use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Group;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\ProjectSubTask;
use App\Models\Task;
use App\Models\User;
use App\Modules\AutomaticGrading\AutomaticGrading;
use App\Modules\AutomaticGrading\AutomaticGradingSettings;
use App\Modules\AutomaticGrading\AutomaticGradingType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

beforeEach(function() {
    /** @var Task $task */
    $task = Task::factory([
        'sub_tasks'       => [
            new SubTask('test 11 Equals [10, 1]', 'test 11 equals [10, 1]'),
            new SubTask('test 9 Equals [5,2,2]', 'test 9 equals [5,2,2]'),
            new SubTask('install', 'install'),
        ],
    ])->for(Course::factory())->make();
    $task->starts_at = '2022-01-28 00:00:00'; // We assign this a date before the created_at date in the pipeline file.

    $task->module_configuration->addModule(AutomaticGrading::class);
    $settings = new AutomaticGradingSettings();
    $settings->gradingType = AutomaticGradingType::ALL_SUBTASKS->value;
    $task->module_configuration->update(AutomaticGrading::class, $settings, $task);
    $task->save();

    $this->project = Project::factory()->for($task)->createQuietly();

});

it('ensures a finished project creates gradings', function() {
    /** @var User $user */
    $user = User::factory()->create();
    $user->projects()->save($this->project);

    $subTasksToCreate = [
        new ProjectSubTask([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ]),
        new ProjectSubTask([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ]),
        new ProjectSubTask([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ]),
    ];
    $this->project->createSubTasks($subTasksToCreate);

    assertDatabaseCount('grades', 1);
    assertDatabaseHas('grades', [
        'user_id'     => $user->id,
        'task_id'     => $this->project->task_id,
        'source_type' => Project::class,
        'source_id'   => $this->project->id,
    ]);
});

it('ensures a finished project creates gradings for group members', function() {
    $group = Group::factory()->create([
        'course_id' => $this->project->task->course_id,
    ]);
    /** @var User $user */
    $users = User::factory(2)->create();
    $group->members()->attach($users);
    $group->projects()->save($this->project);

    $subTasksToCreate = [
        new ProjectSubTask([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ]),
        new ProjectSubTask([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ]),
        new ProjectSubTask([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ]),
    ];
    $this->project->createSubTasks($subTasksToCreate);

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
});

it('ensures a finished project can\'t be graded twice', function() {
    /** @var User $user */
    $user = User::factory()->create();
    $user->projects()->save($this->project);

    $subTasksToCreate = [
        new ProjectSubTask([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ]),
        new ProjectSubTask([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ]),
        new ProjectSubTask([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ]),
    ];
    $this->project->createSubTasks($subTasksToCreate);

    $subTasksToCreate = [
        new ProjectSubTask([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ]),
        new ProjectSubTask([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 2,
        ]),
        new ProjectSubTask([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 3,
        ]),
    ];
    $this->project->createSubTasks($subTasksToCreate);

    assertDatabaseCount('grades', 1);
    assertDatabaseHas('grades', [
        'user_id'     => $user->id,
        'task_id'     => $this->project->task_id,
        'source_type' => Project::class,
        'source_id'   => $this->project->id,
    ]);
});
