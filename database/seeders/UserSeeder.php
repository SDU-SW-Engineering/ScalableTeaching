<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();
        User::factory(1)->admin()->create()->each(function(User $admin) use ($courses) {
            $admin->courses()->attach($courses);
        });
        User::factory(20)->create()->each(function(User $user) use ($courses) {
            $user->courses()->attach($courses->random(4));
        });
    }
}
