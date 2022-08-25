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
            Task::factory(2)->current()->for($course)->create();
            Task::factory(2)->future()->for($course)->create();
        });
    }
}
