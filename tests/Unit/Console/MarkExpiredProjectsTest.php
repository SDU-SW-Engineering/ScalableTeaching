<?php

use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\ProjectStatus;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('marks projects overdue that is active past the deadline', function () {
    Project::factory(3)
        ->active()
        ->for(User::factory(), 'ownable')
        ->for(Task::factory()->for(Course::factory())->create([
            'correction_type' => CorrectionType::PipelineSuccess,
            'ends_at' => Carbon::create(2022, 1, 22),
        ]))->createQuietly();

    Carbon::setTestNow(Carbon::create(2022, 1, 23));

    $this->artisan('tasks:mark-expired')->assertSuccessful();

    expect(Project::all()->pluck('status')->toArray())->toBe([ProjectStatus::Overdue, ProjectStatus::Overdue, ProjectStatus::Overdue]);
});

it('ignores projects that are not past the deadline', function () {
    Project::factory(3)
        ->active()
        ->for(User::factory(), 'ownable')
        ->for(Task::factory()->for(Course::factory())->create([
            'correction_type' => CorrectionType::PipelineSuccess,
            'ends_at' => Carbon::create(2022, 1, 22),
        ]))->createQuietly();

    Carbon::setTestNow(Carbon::create(2022, 1, 21));

    $this->artisan('tasks:mark-expired')->assertSuccessful();

    expect(Project::all()->pluck('status')->toArray())->toBe([ProjectStatus::Active, ProjectStatus::Active, ProjectStatus::Active]);
});

it('ignores projects that are active past the deadline when the task correction type is set to none', function () {
    Project::factory(3)
        ->active()
        ->for(User::factory(), 'ownable')
        ->for(Task::factory()->for(Course::factory())->create([
            'correction_type' => CorrectionType::None,
            'ends_at' => Carbon::create(2022, 1, 22),
        ]))->createQuietly();

    Carbon::setTestNow(Carbon::create(2022, 1, 23));

    $this->artisan('tasks:mark-expired')->assertSuccessful();

    expect(Project::all()->pluck('status')->toArray())->toBe([ProjectStatus::Active, ProjectStatus::Active, ProjectStatus::Active]);
});
