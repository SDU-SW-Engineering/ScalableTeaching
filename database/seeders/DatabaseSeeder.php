<?php

namespace Database\Seeders;

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
        $this->call(CourseSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(GroupSeeder::class);
    }
}
