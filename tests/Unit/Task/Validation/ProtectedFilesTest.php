<?php

use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\Task;
use App\ProjectStatus;
use Domain\SourceControl\SourceControl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;

uses(RefreshDatabase::class);

beforeEach(function() {
    /** @var Project project */
    $this->project = Project::factory()->for(Task::factory([
        'correction_type' => CorrectionType::AllTasks,
        'sub_tasks'       => [
            new SubTask('11 Equals [10, 1]', 'test 11 equals [10, 1]'),
        ],
    ])->for(Course::factory()))->createQuietly();

    $this->project->task->protectedFiles()->createMany([
        [
            'path' => '.gitlab-ci.yml',
            'sha_values' => ['d470caf7cdb76a728911f4934adc1ba17aff6be9']
        ],
        [
            'path' => 'src/test/java/task1/Task1Test.java',
            'sha_values' => ['9faefc1a0c1c371e1f274975aab675ef29f4ac5f']
        ],
        [
            'path' => 'src/test/java/task2/Task2Test.java',
            'sha_values' => ['0eec204f6515fa3b005bf7735f33d1b5508712c9']
        ],
        [
            'path' => 'src/test/java/task3/Task3Test.java',
            'sha_values' => ['fd63e2e589d03e2f52cbd0b9b6c32d0fcf95fde0']
        ],
        [
            'path' => 'src/test/java/task4/Task4Test.java',
            'sha_values' => ['925098a56f12008148878a49166888d075925f4e']
        ],
    ]);
});

it('ensures projects with unaltered protected files pass', function() {
    app(SourceControl::class)->fakePath(new Collection([
        new \Domain\SourceControl\File("/", ".gitlab-ci.yml", "d470caf7cdb76a728911f4934adc1ba17aff6be9"),
        new \Domain\SourceControl\File("/", ".gitignore", "cd19bd6ed01e540ce80dec3910af8b6b1151a8d8"),
        new \Domain\SourceControl\File("src/test/java/task1", "Task1Test.java", "9faefc1a0c1c371e1f274975aab675ef29f4ac5f"),
        new \Domain\SourceControl\File("src/test/java/task2", "Task2Test.java", "0eec204f6515fa3b005bf7735f33d1b5508712c9"),
        new \Domain\SourceControl\File("src/test/java/task3", "Task3Test.java", "fd63e2e589d03e2f52cbd0b9b6c32d0fcf95fde0"),
        new \Domain\SourceControl\File("src/test/java/task4", "Task4Test.java", "925098a56f12008148878a49166888d075925f4e"),
    ]));
    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ],
    ]);

    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Finished);
});

it('ensures projects with altered protected files fail', function() {
    app(SourceControl::class)->fakePath(new Collection([
        new \Domain\SourceControl\File("/", ".gitlab-ci.yml", "d470caf7cdb76a728911f4934adc1ba17aff6be9"),
        new \Domain\SourceControl\File("/", ".gitignore", "cd19bd6ed01e540ce80dec3910af8b6b1151a8d8"),
        new \Domain\SourceControl\File("src/test/java/task1", "Task1Test.java", "9faefc1a0c1c371e1f274975aab675ef29f4ac5d"),
        new \Domain\SourceControl\File("src/test/java/task2", "Task2Test.java", "0eec204f6515fa3b005bf7735f33d1b5508712c9"),
        new \Domain\SourceControl\File("src/test/java/task3", "Task3Test.java", "fd63e2e589d03e2f52cbd0b9b6c32d0fcf95fde0"),
        new \Domain\SourceControl\File("src/test/java/task4", "Task4Test.java", "925098a56f12008148878a49166888d075925f4e"),
    ]));
    $this->project->subTasks()->createMany([
        [
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->succeeding()->for($this->project)->create()->id,
            'sub_task_id' => 1,
        ],
    ]);

    $this->project->refresh();
    expect($this->project->status)->toBe(ProjectStatus::Active)->and(expect($this->project->validation_errors)->not()->toBeEmpty());
});
