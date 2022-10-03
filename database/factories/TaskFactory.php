<?php

namespace Database\Factories;

use App\Models\Enums\CorrectionType;
use App\Models\Enums\TaskTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{

    public function definition()
    {
        $starts_at = $this->faker->dateTimeBetween("-8 weeks", "8 weeks");
        $ends_at = Carbon::instance($starts_at)->addWeeks(rand(2, 4));

        return [
            'name'              => $this->faker->sentence(3),
            'source_project_id' => $this->faker->randomNumber(1, 2000),
            'gitlab_group_id'   => $this->faker->randomNumber(1, 2000),
            'description'       => $this->faker->paragraph(rand(10, 20)),
            'correction_type'   => CorrectionType::None,
            'starts_at'         => $starts_at,
            'ends_at'           => $ends_at,
            'is_visible'        => true,
        ];
    }

    public function invisible()
    {
        return $this->state(function(array $attributes) {
           return [
               'is_visible' => false,
           ];
        });
    }

    public function group($group)
    {
        return $this->state(function(array $attributes) use ($group) {
            return [
                'grouped_by' => $group,
            ];
        });
    }

    public function exercise()
    {
        return $this->state(function(array $attributes) {
            return [
                'type' => TaskTypeEnum::Exercise,
            ];
        });
    }

    public function assignment()
    {
        return $this->state(function(array $attributes) {
            return [
                'type' => TaskTypeEnum::Assignment,
            ];
        });
    }

    public function selfCorrection()
    {
        return $this->state(function(array $attributes) {
            return [
                'correction_type' => CorrectionType::Self,
            ];
        });
    }
}
