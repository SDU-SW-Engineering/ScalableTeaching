<?php

namespace Database\Factories;

use App\Models\Enums\PipelineStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class PipelineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pipeline_id'    => $this->faker->randomNumber(),
            'status'         => $this->faker->randomElement([
                PipelineStatusEnum::Success,
                PipelineStatusEnum::Failed,
                PipelineStatusEnum::Running,
                PipelineStatusEnum::Pending
            ]),
            'runners'        => [$this->faker->text(30)],
            'user_name'      => $this->faker->bothify('?????##'),
            'duration'       => $this->faker->randomFloat(1, 5, 30),
            'queue_duration' => $this->faker->randomFloat(1, 20, 120),
        ];
    }

    public function succeeding()
    {
        return $this->state(function (array $attributes)
        {
            return [
                'status' => PipelineStatusEnum::Success
            ];
        });
    }

    public function failing()
    {
        return $this->state(function (array $attributes)
        {
            return [
                'status' => PipelineStatusEnum::Failed
            ];
        });
    }

    public function running()
    {
        return $this->state(function (array $attributes)
        {
            return [
                'status' => PipelineStatusEnum::Running
            ];
        });
    }

    public function pending()
    {
        return $this->state(function (array $attributes)
        {
            return [
                'status' => PipelineStatusEnum::Pending
            ];
        });
    }
}
