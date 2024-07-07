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

it('marks projects overdue that is active past the deadline', function() {
    Project::factory(3)
        ->active()
        ->for(User::factory(), 'ownable')
        ->for(Task::factory()->for(Course::factory())->create([
            'ends_at'         => Carbon::create(2022, 1, 22),
        ]))->createQuietly();

    Carbon::setTestNow(Carbon::create(2022, 1, 23));

    $this->artisan('tasks:mark-expired')->assertSuccessful();

    expect(Project::all()->pluck('status')->toArray())->toBe([ProjectStatus::Overdue, ProjectStatus::Overdue, ProjectStatus::Overdue]);
});

it('ignores projects that are not past the deadline', function() {
    Project::factory(3)
        ->active()
        ->for(User::factory(), 'ownable')
        ->for(Task::factory()->for(Course::factory())->create([
            'ends_at'         => Carbon::create(2022, 1, 22),
        ]))->createQuietly();

    Carbon::setTestNow(Carbon::create(2022, 1, 21));

    $this->artisan('tasks:mark-expired')->assertSuccessful();

    expect(Project::all()->pluck('status')->toArray())->toBe([ProjectStatus::Active, ProjectStatus::Active, ProjectStatus::Active]);
});


it('ignores projects that are finished', function() {
    Project::factory(3)
        ->finished()
        ->for(User::factory(), 'ownable')
        ->for(Task::factory()->for(Course::factory())->create([
            'ends_at'         => Carbon::create(2022, 1, 22),
        ]))->createQuietly();

    Carbon::setTestNow(Carbon::create(2022, 1, 21));

    $this->artisan('tasks:mark-expired')->assertSuccessful();

    expect(Project::all()->pluck('status')->toArray())->toBe([ProjectStatus::Finished, ProjectStatus::Finished, ProjectStatus::Finished]);
});
