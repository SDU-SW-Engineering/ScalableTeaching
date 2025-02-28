<?php

use App\Events\ProjectDeleting;
use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Grade;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\ProjectDownload;
use App\Models\ProjectFeedback;
use App\Models\ProjectPush;
use App\Models\ProjectSubTaskComment;
use App\Models\Task;
use App\Models\TaskDelegation;
use App\Models\TaskProtectedFile;
use App\Models\User;
use App\Modules\AutomaticGrading\AutomaticGrading;
use App\Modules\AutomaticGrading\AutomaticGradingSettings;
use App\Modules\AutomaticGrading\AutomaticGradingType;
use App\Modules\LinkRepository\LinkRepository;
use App\Modules\LinkRepository\LinkRepositorySettings;
use App\Modules\Template\Template;
use App\ProjectStatus;
use Domain\SourceControl\SourceControl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\call;

uses(RefreshDatabase::class);

/**
 * @param Task $task
 * @return void
 */

/**
 * @param Task $task
 * @param TestCase $this
 * @return void
 */

beforeEach(function() {
    /** @var Task $task */
    $this->task = Task::factory([
        'correction_type' => CorrectionType::AllTasks,
        'sub_tasks'       => [
            new SubTask('11 Equals [10, 1]', 'test 11 equals [10, 1]'),
            new SubTask('12 Equals [10, 2]', 'test 12 equals [10, 2]'),
            new SubTask('13 Equals [10, 3]', 'test 12 equals [10, 3]'),
        ],
    ])->for(Course::factory()->createQuietly())->create();
    $this->professor = User::factory()->admin()->hasAttached($this->task->course)->create();


    foreach (User::factory()->count(3)->createQuietly() as $teacher) {
        $this->task->course->teachers()->attach($teacher->id, ['role' => 'teacher']);
    }

});

it("Deletes all task dependencies (projects, delegations, grades, ect...)", function (){
    actingAs($this->professor);
    createProjectsForTask($this->task, 3);

    $response = call('delete', route("courses.tasks.admin.destroy", [$this->task->course, $this->task]));

    $response->assertRedirect();

    assertDatabaseMissing('tasks', [
        "id" => $this->task->id,
    ]);
    expect($this->task->projects()->get())->toBeEmpty();

    expect(TaskProtectedFile::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(ProjectFeedback::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0)
        ->and(Pipeline::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0)
        ->and(Grade::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(TaskDelegation::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(ProjectDownload::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0);

});

it("Deletes all task dependencies, Task is CodeTask (projects, delegations, grades, ect...)", function (){
    actingAs($this->professor);
    Event::fake(ProjectDeleting::class);// Need to inhibit this event to stop Scalable from attempting to delete the repos from the gitlab
    $this->installLinkRepositoryModule($this->task);
    createProjectsForTask($this->task, 3);

    $response = call('delete',route("courses.tasks.admin.destroy", [$this->task->course, $this->task]));

    $response->assertRedirect();

    assertDatabaseMissing('tasks', [
        "id" => $this->task->id,
    ]);
    expect($this->task->projects()->get())->toBeEmpty();

    expect(TaskProtectedFile::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(ProjectFeedback::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0)
        ->and(Pipeline::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0)
        ->and(Grade::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(TaskDelegation::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(ProjectDownload::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0);

});

it("Deletes all task dependencies, Task is TemplateTask (projects, delegations, grades, ect...)", function (){
    actingAs($this->professor);
    Event::fake(ProjectDeleting::class);// Need to inhibit this event to stop Scalable from attempting to delete the repos from the gitlab
    $this->installLinkRepositoryModule($this->task);
    $this->installTemplateModule($this->task);
    createProjectsForTask($this->task, 3);

    $response = call('delete',route("courses.tasks.admin.destroy", [$this->task->course, $this->task]));

    $response->assertRedirect();

    assertDatabaseMissing('tasks', [
        "id" => $this->task->id,
    ]);
    expect($this->task->projects()->get())->toBeEmpty();

    expect(TaskProtectedFile::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(ProjectFeedback::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0)
        ->and(Pipeline::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0)
        ->and(Grade::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(TaskDelegation::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(ProjectDownload::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0);
});

it("Deletes all task dependencies, Task is TemplateTask and has protected files (projects, delegations, grades, ect...)", function (){
    actingAs($this->professor);
    Event::fake(ProjectDeleting::class);// Need to inhibit this event to stop Scalable from attempting to delete the repos from the gitlab
    $this->installLinkRepositoryModule($this->task);
    $this->installTemplateModule($this->task);
    addProtectedFiles($this->task);
    createProjectsForTask($this->task, 3);

    $response = call('delete',route("courses.tasks.admin.destroy", [$this->task->course, $this->task]));

    $response->assertRedirect();

    assertDatabaseMissing('tasks', [
        "id" => $this->task->id,
    ]);
    expect($this->task->projects()->get())->toBeEmpty();

    expect(TaskProtectedFile::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(ProjectFeedback::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0)
        ->and(Pipeline::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0)
        ->and(Grade::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(TaskDelegation::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(ProjectDownload::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0);
});

it("Deletes all task dependencies, Task is TemplateTask and is automatically graded (projects, delegations, grades, ect...)", function (){
    actingAs($this->professor);
    Event::fake(ProjectDeleting::class);// Need to inhibit this event to stop Scalable from attempting to delete the repos from the gitlab
    $this->installLinkRepositoryModule($this->task);
    $this->installTemplateModule($this->task);
    $this->installAutomaticGradingModule($this->task, AutomaticGradingType::PIPELINE_SUCCESS);
    createProjectsForTask($this->task, 3);

    $response = call('delete',route("courses.tasks.admin.destroy", [$this->task->course, $this->task]));

    $response->assertRedirect();

    assertDatabaseMissing('tasks', [
        "id" => $this->task->id,
    ]);
    expect($this->task->projects()->get())->toBeEmpty();

    expect(TaskProtectedFile::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(ProjectFeedback::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0)
        ->and(Pipeline::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0)
        ->and(Grade::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(TaskDelegation::where('task_id', $this->task->id)->count())->toBe(0)
        ->and(ProjectDownload::whereHas('project', function ($query) {
            $query->where('task_id', $this->task->id);
        })->count())->toBe(0);
});

function createProjectsForTask(Task $task, int $amount): Collection
{
    $collection = new Collection();
    for ($i = 0; $i < $amount; $i++) {
        /** @var Project $project */
        $project = Project::factory()->for($task)->createQuietly();
        $task->sub_tasks->all()->each(function ($subTask) use ($task, $project) {
            $projectSubtask = $project->subTasks()->createQuietly([
                'sub_task_id' => $subTask->getId(),
                'source_type' => Task::class,
                'source_id' => $task->id,
                'points' => $subTask->getPoints(),
            ]);
            ProjectSubTaskComment::factory()->createQuietly([
                'sub_task_id' => $projectSubtask->id,
                'project_id' => $project->id,
                'author_id'      => $project->task->course->teachers()->first()->id,
            ]);
            Pipeline::factory()->createQuietly(['project_id' => $project->id]);
        });

        $project->download()->createQuietly([
            'ref'       => Str::uuid(),
            'expire_at' => now()->addYears(2),
        ]);

        $task->delegations()->save(TaskDelegation::factory()->createQuietly([
            'task_id' => $task->id,
        ]));

        $project->feedback()->saveMany(
            ProjectFeedback::factory()->createQuietly([
            'project_id' => $project->id,
            'task_delegation_id' => $task->delegations()->first()->id,
            'user_id'            => User::factory()->createQuietly()->id,
        ])->all());

        $collection->push($project);
    }
    return $collection;
}

function addProtectedFiles(Task $task): void
{
    $task->protectedFiles()->createMany([
        [
            'path' => '.gitlab-ci.yml',
            'sha_values' => ['d470caf7cdb76a728911f4934adc1ba17aff6be9'],
        ],
        [
            'path' => 'src/test/java/task1/Task1Test.java',
            'sha_values' => ['9faefc1a0c1c371e1f274975aab675ef29f4ac5f'],
        ],
        [
            'path' => 'src/test/java/task2/Task2Test.java',
            'sha_values' => ['0eec204f6515fa3b005bf7735f33d1b5508712c9'],
        ],
        [
            'path' => 'src/test/java/task3/Task3Test.java',
            'sha_values' => ['fd63e2e589d03e2f52cbd0b9b6c32d0fcf95fde0'],
        ],
        [
            'path' => 'src/test/java/task4/Task4Test.java',
            'sha_values' => ['925098a56f12008148878a49166888d075925f4e'],
        ],
    ]);
}
