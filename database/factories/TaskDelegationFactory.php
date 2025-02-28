<?php

namespace Database\Factories;

use App\Models\Enums\TaskDelegationType;
use App\Models\TaskDelegation;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Symfony\Component\Translation\t;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskDelegation>
 */
class TaskDelegationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number_of_projects' => $this->faker->numberBetween(0, 10),
            'type'               => $this->faker->randomElement(TaskDelegationType::cases()),
            'grading'            => $this->faker->boolean(),
            'feedback'           => $this->faker->boolean(),
            'is_anonymous'       => $this->faker->boolean(),
            'is_moderated'       => $this->faker->boolean(),
            'deadline_at'        => now()->addDays(2),
            'delegated'          => $this->faker->boolean(),
        ];
    }
}
