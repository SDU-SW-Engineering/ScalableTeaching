<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::all()->each(function(Course $course) {
            Task::factory(rand(1, 4))->for($course)->create();

            foreach(["Group A", "Group B", "Group C"] as $group)
            {
                Task::factory(rand(3, 6))->group($group)->for($course)->create();
                Task::factory(1)->group($group)->invisible()->for($course)->create();
            }

            Task::factory(rand(3, 6))->for($course)->create();
        });
    }
}
