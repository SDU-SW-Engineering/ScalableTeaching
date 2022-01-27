<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{

    public function definition()
    {
        return [
            'name'              => $this->faker->sentence(3),
            'source_project_id' => $this->faker->randomNumber(1, 2000),
            'gitlab_group_id'   => $this->faker->randomNumber(1, 2000),
            'starts_at'         => now(),
            'ends_at'           => $this->faker->dateTimeBetween("1 week", "5 weeks"),
            'is_visible'        => true
        ];
    }
}
