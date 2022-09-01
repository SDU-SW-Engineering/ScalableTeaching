<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::has('roles', '=', 0)->each(function(Course $course) {
            $course->roles()->createMany([
                [
                    'name'    => 'Student',
                    'default' => true,
                ],
                [
                    'name' => 'Teaching Assistant',
                ],
                [
                    'name' => 'Professor',
                ],
            ]);
        });
    }
}
