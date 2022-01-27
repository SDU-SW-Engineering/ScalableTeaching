<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->admin()->create();
        Course::factory()->count(3)
            ->has(User::factory()->count(10), 'members')
            ->has(Task::factory()->count(3))
            ->create()->each(fn(Course $course) => $course->teachers()->attach($admin->id));
    }
}
