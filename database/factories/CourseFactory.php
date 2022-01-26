<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{

    public function definition()
    {
        return [
            'name'            => $this->faker->sentence(3),
            'gitlab_group_id' => $this->faker->numberBetween(10, 2000)
        ];
    }
}
