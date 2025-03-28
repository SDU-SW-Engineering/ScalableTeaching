<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectFeedback>
 */
class ProjectFeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pseudonym' => $this->faker->word(),
            'sha'       => $this->faker->sha256(),
            'reviewed'  => $this->faker->boolean(),
        ];
    }
}
