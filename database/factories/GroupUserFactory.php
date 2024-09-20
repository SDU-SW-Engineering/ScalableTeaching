<?php

namespace Database\Factories;

use App\Models\GroupUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupUserFactory extends Factory
{

    protected $model = GroupUser::class;

    public function definition(): array
    {
        return [
            "is_owner" => false,
        ];
    }

    public function owner(): GroupUserFactory
    {
        return $this->state(function () {
            return [
                'is_owner' => true,
            ];
        });
    }

}
