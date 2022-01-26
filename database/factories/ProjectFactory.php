<?php

namespace Database\Factories;

use App\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_id'      => '',
            'project_id'   => $this->faker->randomNumber(),
            'repo_name'    => $this->faker->word,
            'status'       => ProjectStatus::Active,
        ];
    }
}
