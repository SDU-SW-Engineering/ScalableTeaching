<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3)
        ];
    }
}
