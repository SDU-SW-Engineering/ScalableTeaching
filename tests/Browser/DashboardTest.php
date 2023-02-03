<?php

namespace Tests\Browser;

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
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
                ->visit('/')
                ->assertSee($this->courses[0]->name)
                ->assertSee($this->courses[1]->name);
        });
    }

    public function test_a_user_can_see_assignment(): void
    {
        $this->course = Course::factory()->create();
        $this->user = User::factory()->hasAttached($this->course)->create();
        $this->tasks = Task::factory()->for($this->course)->visible()->create([
            'ends_at' => now()->addWeek(),
        ]);
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/')
                ->assertSee($this->tasks->name);
        });
    }
}
