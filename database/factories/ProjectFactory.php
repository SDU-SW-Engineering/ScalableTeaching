<?php

namespace Database\Factories;

use App\Models\Enums\CorrectionType;
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
            'task_id'                => '',
            'gitlab_project_id'      => $this->faker->randomNumber(),
            'repo_name'              => $this->faker->bothify("?????##"),
            'status'                 => ProjectStatus::Active,
        ];
    }

    /**
     * Indicate that the project is active.
     *
     * @return Factory
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => ProjectStatus::Active,
            ];
        });
    }

    /**
     * Indicate that the project is active.
     *
     * @return Factory
     */
    public function finished()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => ProjectStatus::Finished,
            ];
        });
    }

    public function overdue()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => ProjectStatus::Overdue,
            ];
        });
    }
}
