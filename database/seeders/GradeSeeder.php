<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Task;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    public function run()
    {
        Course::all()->each(function (Course $course) {
            $students = $course->students()->get();

            if ($students->isEmpty()) {
                return;
            }

            $tasks = $course->tasks()
                ->where('grouped_by', '!=', 'sidebar')
                ->get();

            foreach ($tasks as $task) {
                $engagement = rand(30, 100) / 100;

                $engagedStudents = $students
                    ->shuffle()
                    ->take((int) round($students->count() * $engagement));

                foreach ($engagedStudents as $student) {
                    Grade::factory()->create([
                        'task_id' => $task->id,
                        'user_id' => $student->id,
                        'source_type' => Task::class,
                        'source_id' => $task->id,
                    ]);
                }
            }
        });
    }
}