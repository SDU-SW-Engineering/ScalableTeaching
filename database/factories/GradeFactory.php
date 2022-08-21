<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => 'passed',
        ];
    }

    public function passed(): Factory
    {
        return $this->state(function(array $attributes) {
            return [
                'value' => 'passed',
            ];
        });
    }

    public function failed(): Factory
    {
        return $this->state(function(array $attributes) {
            return [
                'value' => 'failed',
            ];
        });
    }
}
