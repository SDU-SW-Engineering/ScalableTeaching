<?php

use App\Models\Casts\SubTask;
use App\Models\Casts\SubTaskCollection;
use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\GradeEnum;
use App\Models\Grade;
use App\Models\GradeDelegation;
use App\Models\Group;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\ProjectDownload;
use App\Models\ProjectPush;
use App\Models\Task;
use App\Models\User;
use App\ProjectStatus;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has downloads', function() {
    $project = Project::factory()
        ->for(Task::factory(['ends_at' => Carbon::now()->addMonth()])
            ->for(Course::factory()))
        ->has(ProjectDownload::factory(3), 'downloads')
        ->createQuietly();

    expect($project->downloads)->toHaveLength(3);
});

it('has gradeDelegations', function() {
    $project = Project::factory()
        ->for(Task::factory(['ends_at' => Carbon::now()->addMonth()])
            ->for(Course::factory()))
        ->createQuietly();

    GradeDelegation::factory()->for(User::factory())->for($project)->create();
    GradeDelegation::factory()->for(User::factory())->for($project)->create();
    GradeDelegation::factory()->for(User::factory())->for($project)->create();

    expect($project->gradeDelegations)->toHaveLength(3);
});

test('owners returns the user when project is user ownable', function() {
    $user = User::factory()->create();
    $project = Project::factory()
        ->for(Task::factory([
            'ends_at'         => Carbon::now()->subMonth(),
            'correction_type' => CorrectionType::Manual,
        ])->for(Course::factory()))
        ->for($user, 'ownable')
        ->createQuietly();

    $owners = $project->owners();
    expect($owners)->toHaveLength(1);
    expect($owners->first()->id)->toBe($user->id);
});

test('owners returns all the group members when project is group ownable', function() {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $task = Task::factory([
        'ends_at'         => Carbon::now()->subMonth(),
        'correction_type' => CorrectionType::Manual,
    ])->for(Course::factory())->create();

    $group = Group::factory(['course_id' => $task->course_id])->hasAttached($user1, [], 'members')->hasAttached($user2, [], 'members')->create();
    $project = Project::factory()
        ->for($task)
        ->for($group, 'ownable')
        ->createQuietly();

    $owners = $project->owners();
    expect($owners)->toHaveLength(2);
    expect($owners->pluck('id')->toArray())->toEqualCanonicalizing([$user1->id, $user2->id]);
});

test('duration returns null if the task is not done', function() {
    $project = Project::factory()->for(Task::factory(['ends_at' => Carbon::now()->addMonth()])->for(Course::factory()))->createQuietly();

    expect($project->duration)->toBeNull();
});

test('duration returns 2 if the task has been completed two days ago', function() {
    $source = Carbon::now()->addMonth();
    $project = Project::factory()
        ->for(Task::factory(['ends_at' => $source])->for(Course::factory()))->createQuietly(
            [
                'created_at'  => $source->clone(),
                'finished_at' => $source->clone()->addDays(2),
            ]
        );

    expect($project->duration)->toBe('2.00');
});

test('dailyBuilds returns an empty collection when no start date is specified', function() {
    $project = Project::factory()->for(Task::factory(['ends_at' => Carbon::now()->addMonth()])->for(Course::factory()))->createQuietly();

    expect($project->dailyBuilds())->toBeEmpty();
});

test('dailyBuilds returns an array of days between start date and day before now', function() {
    $start = Carbon::now()->subMonth();
    $end = Carbon::now()->addMonth();
    $project = Project::factory()->for(Task::factory([
        'starts_at' => $start,
        'ends_at'   => $end,
    ])->for(Course::factory()))->createQuietly();

    $dailyBuilds = $project->dailyBuilds();
    $days = $dailyBuilds->map(fn($v, $k) => $k)->values();
    expect($days[0])->toBe($start->format('Y-m-d'));
    expect($days[count($days) - 1])->toBe(now()->subDay()->format('Y-m-d'));
    expect($dailyBuilds)->toHaveLength($start->diff(now())->days);
});

test('dailyBuilds returns an array of days between start date and now', function() {
    $start = Carbon::now()->subMonth();
    $end = Carbon::now()->addMonth();
    $project = Project::factory()->for(Task::factory([
        'starts_at' => $start,
        'ends_at'   => $end,
    ])->for(Course::factory()))->createQuietly();

    $dailyBuilds = $project->dailyBuilds(true);
    $days = $dailyBuilds->map(fn($v, $k) => $k)->values();
    expect($days[0])->toBe($start->format('Y-m-d'));
    expect($days[count($days) - 1])->toBe(now()->format('Y-m-d'));
    expect($dailyBuilds)->toHaveLength($start->diff(now())->days + 1);
});

test('dailyBuilds returns an array with appropriate count of builds', function() {
    $start = Carbon::now()->subMonth();
    $end = Carbon::now()->addMonth();
    $project = Project::factory()->for(Task::factory([
        'starts_at' => $start,
        'ends_at'   => $end,
    ])->for(Course::factory()))
        ->has(Pipeline::factory(3, [
            'created_at' => $start->clone()->addDays(3),
        ]), 'pipelines')
        ->has(Pipeline::factory(4, [
            'created_at' => $start->clone()->addDays(13),
        ]), 'pipelines')
        ->createQuietly();

    $dailyBuilds = $project->dailyBuilds(true);
    expect($dailyBuilds->sum())->toBe(7);
    expect($dailyBuilds[$start->clone()->addDays(3)->format('Y-m-d')])->toBe(3);
    expect($dailyBuilds[$start->clone()->addDays(13)->format('Y-m-d')])->toBe(4);
});

test('progress returns 0 when correction type is PointsRequired and no subtasks are completed', function() {
    $project = Project::factory()->for(Task::factory([
        'ends_at'         => Carbon::now()->addMonth(),
        'correction_type' => CorrectionType::PointsRequired,
    ])->for(Course::factory()))->createQuietly();

    $subTasks = new SubTaskCollection();
    $subTasks->add((new SubTask("Test 1"))->setPoints(30));
    $subTasks->add((new SubTask("Test 2"))->setPoints(40));
    $subTasks->add((new SubTask("Test 3"))->setPoints(50));
    $project->task->update(['sub_tasks' => $subTasks]);
    $project->refresh();

    expect($project->progress())->toBe(0);
});

test('progress returns 25 when correction type is PointsRequired and one of three subtasks are completed', function() {
    $project = Project::factory()->for(Task::factory([
        'ends_at'         => Carbon::now()->addMonth(),
        'correction_type' => CorrectionType::PointsRequired,
    ])->for(Course::factory()))->createQuietly();

    $subTasks = new SubTaskCollection();
    $subTasks->add((new SubTask("Test 1"))->setPoints(30));
    $subTasks->add((new SubTask("Test 2"))->setPoints(40));
    $subTasks->add((new SubTask("Test 3"))->setPoints(50));
    $project->task->update(['sub_tasks' => $subTasks]);
    $project->refresh();

    $project->subTasks()->create([
        'sub_task_id' => 1,
        'source_type' => Project::class,
        'source_id'   => $project->id,
    ]);

    expect($project->progress())->toBe(25);
});

test('progress returns 0 when correction type is not PointsRequired and no subtasks are completed', function() {
    $project = Project::factory()->for(Task::factory([
        'ends_at'         => Carbon::now()->addMonth(),
        'correction_type' => CorrectionType::AllTasks,
    ])->for(Course::factory()))->createQuietly();

    $subTasks = new SubTaskCollection();
    $subTasks->add((new SubTask("Test 1"))->setPoints(30));
    $subTasks->add((new SubTask("Test 2"))->setPoints(40));
    $subTasks->add((new SubTask("Test 3"))->setPoints(50));
    $project->task->update(['sub_tasks' => $subTasks]);
    $project->refresh();

    expect($project->progress())->toBe(0);
});

test('progress returns 25 when correction type is not PointsRequired and one of three subtasks are completed', function() {
    $project = Project::factory()->for(Task::factory([
        'ends_at'         => Carbon::now()->addMonth(),
        'correction_type' => CorrectionType::AllTasks,
    ])->for(Course::factory()))->createQuietly();

    $subTasks = new SubTaskCollection();
    $subTasks->add((new SubTask("Test 1"))->setPoints(30));
    $subTasks->add((new SubTask("Test 2"))->setPoints(40));
    $subTasks->add((new SubTask("Test 3"))->setPoints(50));
    $project->task->update(['sub_tasks' => $subTasks]);
    $project->refresh();

    $project->subTasks()->create([
        'sub_task_id' => 1,
        'source_type' => Project::class,
        'source_id'   => $project->id,
    ]);

    expect($project->progress())->toBe(33);
});

test('progress returns 100 when correction type is not manual or required tasks and the project is finished', function() {
    $project = Project::factory([
        'status' => ProjectStatus::Finished,
    ])->for(Task::factory([
        'ends_at'         => Carbon::now()->addMonth(),
        'correction_type' => CorrectionType::AllTasks,
    ])->for(Course::factory()))->createQuietly();

    $subTasks = new SubTaskCollection();
    $subTasks->add((new SubTask("Test 1"))->setPoints(30));
    $subTasks->add((new SubTask("Test 2"))->setPoints(40));
    $subTasks->add((new SubTask("Test 3"))->setPoints(50));
    $project->task->update(['sub_tasks' => $subTasks]);
    $project->refresh();

    $project->subTasks()->create([
        'sub_task_id' => 1,
        'source_type' => Project::class,
        'source_id'   => $project->id,
    ]);

    expect($project->progress())->toBe(100);
});

test('progress returns 0 when correction type is manual and there are no subtaks', function() {
    $project = Project::factory([
        'status' => ProjectStatus::Finished,
    ])->for(Task::factory([
        'ends_at'         => Carbon::now()->addMonth(),
        'correction_type' => CorrectionType::Manual,
    ])->for(Course::factory()))->createQuietly();
    expect($project->progress())->toBe(0);
});


test('validationStatus returns pending when validated_at is null', function() {
    $project = Project::factory()
        ->for(Task::factory(['ends_at' => Carbon::now()->addMonth()])->for(Course::factory()))->createQuietly([
            'validated_at' => null,
        ]);

    expect($project->validationStatus)->toBe('pending');
});

test('validationStatus returns failed when validation_errors length is larger than 0', function() {
    $project = Project::factory()
        ->for(Task::factory(['ends_at' => Carbon::now()->addMonth()])->for(Course::factory()))->createQuietly([
            'validation_errors' => [1, 2, 3],
            'validated_at'      => now(),
        ]);

    expect($project->validationStatus)->toBe('failed');
});

test('validationStatus returns success when validation_errors length is 0', function() {
    $project = Project::factory()
        ->for(Task::factory(['ends_at' => Carbon::now()->addMonth()])->for(Course::factory()))->createQuietly([
            'validation_errors' => [],
            'validated_at'      => now(),
        ]);

    expect($project->validationStatus)->toBe('success');
});

test('static isCorrectToken returns true if token matches the project', function() {
    $secret = 'testing-scalable';
    Config::set('scalable.webhook_secret', $secret);
    $project = Project::factory()->for(Task::factory(['ends_at' => Carbon::now()->addMonth()])->for(Course::factory()))->createQuietly();

    expect(Project::isCorrectToken($project, md5(strtolower($project->project_id) . $secret)))->toBeTrue();
});

test('static isCorrectToken returns false if token does not match the project', function() {
    $secret = 'testing-scalable';
    Config::set('scalable.webhook_secret', $secret);
    $project = Project::factory()->for(Task::factory(['ends_at' => Carbon::now()->addMonth()])->for(Course::factory()))->createQuietly();

    expect(Project::isCorrectToken($project, "hello-world"))->toBeFalse();
});


test('static token returns the passed projects token', function() {
    $secret = 'testing-scalable';
    Config::set('scalable.webhook_secret', $secret);
    $project = Project::factory()->for(Task::factory(['ends_at' => Carbon::now()->addMonth()])->for(Course::factory()))->createQuietly();

    expect(Project::token($project))->toBe(md5(strtolower($project->project_id) . $secret));
    expect(Project::token(11))->toBe(md5(11 . $secret));
});


test('isMissed returns false when the task hasn\'t ended', function() {
    $project = Project::factory()->for(Task::factory(['ends_at' => Carbon::now()->addMonth()])->for(Course::factory()))->createQuietly();

    expect($project->isMissed)->toBeFalse();
});

test('isMissed returns true when project is overdue and CorrectionType is not manual or none', function() {
    $project = Project::factory()->for(Task::factory([
        'ends_at'         => Carbon::now()->subMonth(),
        'correction_type' => CorrectionType::PipelineSuccess,
    ])->for(Course::factory()))->createQuietly([
        'status' => ProjectStatus::Overdue,
    ]);

    expect($project->isMissed)->toBeTrue();
});

test('isMissed returns false when project is finished and CorrectionType is not manual or none', function() {
    $project = Project::factory()->for(Task::factory([
        'ends_at'         => Carbon::now()->subMonth(),
        'correction_type' => CorrectionType::PipelineSuccess,
    ])->for(Course::factory()))->createQuietly([
        'status' => ProjectStatus::Finished,
    ]);

    expect($project->isMissed)->toBeFalse();
});

test('isMissed returns true when task has ended and is manual and the project has no pushes', function() {
    $project = Project::factory()->for(Task::factory([
        'ends_at'         => Carbon::now()->subMonth(),
        'correction_type' => CorrectionType::Manual,
    ])->for(Course::factory()))->createQuietly();

    expect($project->isMissed)->toBeTrue();
});

test('isMissed returns true when task has ended and is manual and the project\'s pushes are after the deadline', function() {
    $deadline = Carbon::now()->subMonth();
    $project = Project::factory()->for(Task::factory([
        'ends_at'         => $deadline,
        'correction_type' => CorrectionType::Manual,
    ])->for(Course::factory()))->has(ProjectPush::factory([
        'created_at' => $deadline->clone()->addHour(),
    ]), 'pushes')->createQuietly();

    expect($project->isMissed)->toBeTrue();
});

test('isMissed returns false when task has ended and is manual and the project\'s pushes are before the deadline', function() {
    $deadline = Carbon::now()->subMonth();
    $project = Project::factory()->for(Task::factory([
        'ends_at'         => $deadline,
        'correction_type' => CorrectionType::Manual,
    ])->for(Course::factory()))->has(ProjectPush::factory([
        'created_at' => $deadline->clone()->subHour(),
    ]), 'pushes')->createQuietly();

    expect($project->isMissed)->toBeFalse();
});

test('latestDownload returns null when the project has no pushes', function() {
    $project = Project::factory()->for(Task::factory([
        'ends_at'         => Carbon::now()->subMonth(),
        'correction_type' => CorrectionType::Manual,
    ])->for(Course::factory()))->createQuietly();

    expect($project->latestDownload())->toBeNull();
});

test('latestDownload returns null when the project\'s pushes are after the deadline', function() {
    $deadline = Carbon::now()->subMonth();
    $project = Project::factory()->for(Task::factory([
        'ends_at'         => $deadline,
        'correction_type' => CorrectionType::Manual,
    ])->for(Course::factory()))->has(ProjectPush::factory([
        'created_at' => $deadline->clone()->addHour(),
    ]), 'pushes')->createQuietly();

    expect($project->latestDownload())->toBeNull();
});

test('latestDownload returns an instance of ProjectDownload when the project\'s pushes are before the deadline and a download has been requested', function() {
    $deadline = Carbon::now()->subMonth();
    $project = Project::factory()->for(Task::factory([
        'ends_at'         => $deadline,
        'correction_type' => CorrectionType::Manual,
    ])->for(Course::factory()))
        ->createQuietly();
    $projectPush = ProjectPush::factory([
        'created_at' => $deadline->clone()->subHour(),
    ])->for($project)->create();

    ProjectDownload::factory([
        'ref' => $projectPush->after_sha,
    ])->for($project)->create();

    expect($project->latestDownload())->toBeInstanceOf(ProjectDownload::class);
});

test('latestDownload returns null when the project\'s pushes are before the deadline and a download has not been requested', function() {
    $deadline = Carbon::now()->subMonth();
    $project = Project::factory()
        ->for(Task::factory([
            'ends_at'         => $deadline,
            'correction_type' => CorrectionType::Manual,
        ])->for(Course::factory()))->has(ProjectPush::factory([
            'created_at' => $deadline->clone()->subHour(),
        ]), 'pushes')
        ->createQuietly();

    expect($project->latestDownload())->toBeNull();
});

test('setProjectStatusFor updates the status and creates grades for all users', function() {
    $user = User::factory()->create();
    $task = Task::factory([
        'ends_at'         => Carbon::now()->subMonth(),
        'correction_type' => CorrectionType::Manual,
    ])->for(Course::factory())->create();
    $project = Project::factory()
        ->for($task)
        ->for($user, 'ownable')
        ->createQuietly();

    $project->setProjectStatusFor(ProjectStatus::Finished, Task::class, $task->id);
    expect($project->status)->toBe(ProjectStatus::Finished);

    $grade = Grade::where('task_id', $task->id)->where('user_id', $user->id)->first();
    expect($grade)->not()->toBeNull();
    expect($grade->source_type)->toBe(Task::class);
    expect($grade->source_id)->toBe($task->id);
    expect($grade->value)->toBe(GradeEnum::Passed);
});

test('setProjectStatus updates the status and creates grades for all users', function() {
    $user = User::factory()->create();
    $task = Task::factory([
        'ends_at'         => Carbon::now()->subMonth(),
        'correction_type' => CorrectionType::Manual,
    ])->for(Course::factory())->create();
    $project = Project::factory()
        ->for($task)
        ->for($user, 'ownable')
        ->createQuietly();

    $project->setProjectStatus(ProjectStatus::Overdue);
    expect($project->status)->toBe(ProjectStatus::Overdue);

    $grade = Grade::where('task_id', $task->id)->where('user_id', $user->id)->first();
    expect($grade)->not()->toBeNull();
    expect($grade->source_type)->toBe(Project::class);
    expect($grade->source_id)->toBe($project->id);
    expect($grade->value)->toBe(GradeEnum::Failed);
});
