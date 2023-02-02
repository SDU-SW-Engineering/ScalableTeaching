<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'gitlab_group_id' => $this->faker->numberBetween(10, 2000),
            'enroll_token' => Str::random(32),
            'created_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
