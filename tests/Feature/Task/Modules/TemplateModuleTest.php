<?php

/**
 * This file tests the Template module, that can be installed on a task, and it's related features.
 */

use App\Models\Course;
use App\Models\Task;
use App\Modules\LinkRepository\LinkRepository;
use App\Modules\LinkRepository\LinkRepositorySettings;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class)->group("feature", "task", "modules");

beforeEach(function() {
    $this->course = Course::factory()->create();

    /**
     * @var Task $task
     */
    $task = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at'   => Carbon::create(2022, 8, 24, 23, 59, 59),
    ])->for($this->course)->create();
    $task->module_configuration->addModule(LinkRepository::class);
    $settings = new LinkRepositorySettings();
    $settings->repo = "mock-id";
    $task->module_configuration->update(LinkRepository::class, $settings);
    $task->save();
    $this->task = $task;

    $this->professor = UserFactory::new()->admin()->hasAttached($this->course)->create();
    $this->user = UserFactory::new()->hasAttached($this->course)->create();

    /*
    $this->projectByUser = Project::factory([
        "task_id" => $task,
    ])->for($this->user, 'ownable')->create();
    */
    Carbon::setTestNow(Carbon::create(2022, 8, 16));
    actingAs($this->professor);
});

it('fails installing when link repository is not installed', function () {
    $task = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at'   => Carbon::create(2022, 8, 24, 23, 59, 59),
    ])->for($this->course)->create();
    $task->save();



    get(route('courses.tasks.admin.modules.install', [$this->course, $task, "module" => "Template"]))
        ->assertSessionHas("error", "You cannot install the Template module due to errors.");
});

it('fails installing when link repository is not configured', function () {
    $task = Task::factory([
        'starts_at' => Carbon::create(2022, 8, 8, 12),
        'ends_at'   => Carbon::create(2022, 8, 24, 23, 59, 59),
    ])->for($this->course)->create();
    $task->module_configuration->addModule(LinkRepository::class);
    $task->save();

    get(route('courses.tasks.admin.modules.install', [$this->course, $task, "module" => "Template"]))
        ->assertSessionHas("error", "You cannot install the Template module due to errors.");;
});

it('fails when a student tries to install', function () {
    actingAs($this->user);

    get(route('courses.tasks.admin.modules.install', [$this->course, $this->task, "module" => "Template"]))
        ->assertStatus(403);
});

it('successfully installs when link repository is configured', function () {
    get(route('courses.tasks.admin.modules.install', [$this->course, $this->task, "module" => "Template"]))
        ->assertStatus(302)
        ->assertSessionMissing("error");
});

it('should fork configured gitlab project');


?>
