<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                Task::factory(rand(3, 6))->group($group)->exercise()->for($course)->create();
            }

            Task::factory(rand(3, 6))->exercise()->for($course)->create();
        });
    }
}
