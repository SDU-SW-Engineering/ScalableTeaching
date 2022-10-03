<?php

namespace Tests\Browser;

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Str;
use Tests\DuskTestCase;

class DashboardTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function test_a_user_can_see_courses(): void
    {
        $this->courses = Course::factory(2)->create();
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->hasAttached($this->courses)->create())
                ->visit('/dashboard')
                ->assertSee($this->courses[0]->name)
                ->assertSee($this->courses[1]->name);
        });
    }

    public function test_a_user_can_click_on_a_course(): void
    {
        $this->course = Course::factory()->create();
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->hasAttached($this->courses)->create())
                ->visit('/dashboard')
                ->assertSee($this->course->name)
                ->click($this->course->name)
                ->assertSee($this->course->name);
        });
    }

    public function test_a_user_can_see_assignments(): void
    {
        $this->course = Course::factory()->create();
        $this->user = User::factory()->hasAttached($this->course)->create();
        $this->tasks = Task::factory()->for($this->course)->visible()->count(2)->create([
            'ends_at' => now()->addWeek(),
        ]);
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/dashboard')
                ->assertSee($this->tasks[0]->name)
                ->assertSee($this->tasks[0]->starts_at)
                ->assertSee($this->tasks[0]->ends_at)
                ->assertSee(Str::words($this->tasks[0]->description, 30))
                ->assertSee($this->tasks[1]->name)
                ->assertSee($this->tasks[1]->starts_at)
                ->assertSee($this->tasks[1]->ends_at)
                ->assertSee(Str::words($this->tasks[1]->description, 30));
        });
    }

    public function test_a_user_can_see_exercises(): void
    {
        $this->course = Course::factory()->create();
        $this->user = User::factory()->hasAttached($this->course)->create();
        $this->tasks = Task::factory()->for($this->course)->visible()->count(2)->create([
            'type' => 'exercise',
        ]);
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/dashboard')
                ->assertSee($this->tasks[0]->name)
                ->assertSee($this->tasks[0]->starts_at)
                ->assertSee($this->tasks[0]->ends_at)
                ->assertSee(Str::words($this->tasks[0]->description, 20))
                ->assertSee($this->tasks[1]->name)
                ->assertSee($this->tasks[1]->starts_at)
                ->assertSee($this->tasks[1]->ends_at)
                ->assertSee(Str::words($this->tasks[1]->description, 20));
        });
    }
}
