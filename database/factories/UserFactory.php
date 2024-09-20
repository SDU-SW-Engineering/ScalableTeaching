<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'           => $this->faker->name(),
            'email'          => $this->faker->unique()->safeEmail(),
            'gitlab_id'      => $this->faker->unique()->numberBetween(1_000_000), // Up this value, to avoid clashing with real gitlab users for test purposes.
            'remember_token' => Str::random(10),
            'username'       => $this->faker->userName,
            'last_login'     => now(),
        ];
    }

    /**
     * Indicate the user should be a system administrator
     *
     * @return UserFactory
     */
    public function system_admin(): UserFactory
    {
        return $this->state(function () {
           return [
               'is_sys_admin' => true,
           ];
        });
    }

    /**
     * * Indicate the user should be a professor (Administrator)
     *
     * @return UserFactory
     */
    public function admin(): UserFactory
    {
        return $this->state(function() {
            return [
                'is_admin' => true,
            ];
        });
    }
}
