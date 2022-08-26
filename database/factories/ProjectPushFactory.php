<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectPush>
 */
class ProjectPushFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'before_sha' => $this->faker->sha256,
            'after_sha'  => $this->faker->sha256,
            'ref'        => 'origin/master',
            'username'   => $this->faker->userName,
        ];
    }
}
