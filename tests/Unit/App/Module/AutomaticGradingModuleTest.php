<?php

use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\Task;
use App\Modules\AutomaticGrading\AutomaticGrading;
use App\Modules\AutomaticGrading\AutomaticGradingType;
use App\Modules\LinkRepository\LinkRepositorySettings;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\partialMock;
use function PHPUnit\Framework\assertGreaterThan;

uses(RefreshDatabase::class)->group('unit', 'app', 'module');

beforeEach(function() {
    $this->course = Course::factory()->create();

    $this->subtasks = createSubTasks([
        ['title' => 'test 11 Equals [10, 1]', 'points' => 50],
        ['title' => 'test 9 Equals [5,2,2]', 'points' => 25],
        ['title' => 'install', 'points' => 40],
    ]);

    /**
     * @var Task $task
     */
    $task = Task::factory([
        'sub_tasks'       => [
            new SubTask('test 11 Equals [10, 1]', 'test 11 equals [10, 1]'),
            new SubTask('test 9 Equals [5,2,2]', 'test 9 equals [5,2,2]'),
            new SubTask('install', 'install'),
        ],
    ])->for($this->course)->create();

    installLinkRepositoryModule($task);
    installTemplateModule($task);
    installBuildTrackingModule($task);


    $task->save();
    $this->task = $task;

    $this->professor = UserFactory::new()->admin()->hasAttached($this->course)->create();

    actingAs($this->professor);
});

it('is not enabled if settings is not automatic grading settings', function() {
    $this->task->module_configuration->addModule(AutomaticGrading::class);
    $this->task->module_configuration->update(AutomaticGrading::class, new LinkRepositorySettings(), $this->task);

    expect($this->task->module_configuration->isEnabled(AutomaticGrading::class))->toBeFalse();
});

it('is enabled if settings is automatic grading settings', function() {
    installAutomaticGradingModule($this->task, AutomaticGradingType::PIPELINE_SUCCESS);

    expect($this->task->module_configuration->isEnabled(AutomaticGrading::class))->toBeTrue();
});

it('does not recreate any subtasks when updating if no subtasks have been completed', function() {

    Project::factory()->for($this->task)->createQuietly();

    installAutomaticGradingModule($this->task, AutomaticGradingType::ALL_SUBTASKS);
})->skip("Figure out best way to test methods executed on relationships");

it('recreates subtasks when updating if subtasks have been completed', function() {
    $project = Project::factory()->for($this->task)->createQuietly();

    foreach ($this->subtasks as $subtask)
    {
        $project->subTasks()->create([
            'source_type' => Pipeline::class,
            'source_id'   => Pipeline::factory()->for($project)->create()->id,
            'sub_task_id' => $subtask->id,
            'points'      => $subtask->points,
        ]);
    }
    $project->refresh();

    $createdTime = $project->subTasks()->first()->created_at;

    // Fake the update being a day later.
    Carbon::setTestNow(Carbon::parse($createdTime)->addDay());

    installAutomaticGradingModule($this->task, AutomaticGradingType::ALL_SUBTASKS);

    assertGreaterThan(Carbon::parse($createdTime)->valueOf(), Carbon::parse($project->subTasks()->first()->created_at)->valueOf());
});
