<?php

use App\Models\Course;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\ProjectStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->task = Task::factory()->for(Course::factory())->create();

    $this->professor = User::factory()->admin()->hasAttached($this->task->course)->create();
    $this->student = User::factory()->hasAttached($this->task->course)->create();

    Project::factory()->for($this->task)->create();
    Project::factory()->finished()->for($this->task)->create();
    Project::factory()->overdue()->for($this->task)->create(
        [
            'ownable_id'    => $this->student->id,
            'ownable_type'  => User::class,
        ]
    );
    Project::factory()->overdue()->for($this->task)->create();
    
});

it('should not allow access for students', function() {
    actingAs($this->student);

    $response = $this->get(route('courses.tasks.admin.index', ['course' => $this->task->course->id, 'task' => $this->task]));

    $response->assertStatus(403);
});

it('should return correct values for task overview', function() {
    actingAs($this->professor);
    $response = $this->get(route('courses.tasks.admin.index', ['course' => $this->task->course->id, 'task' => $this->task]));

    $response->assertStatus(200);
    $response->assertViewIs('tasks.admin.index');
    $response->assertViewHas('task', $this->task);
    $response->assertViewHas('projectCount', 4);
    $response->assertViewHas('finishedCount', 1);
    expect(
        $this->task->projects()
            ->where('status', ProjectStatus::Overdue)
            ->count()
    )->toBe(2);
    $response->assertViewHas('failedCount', 1);
});

?>
