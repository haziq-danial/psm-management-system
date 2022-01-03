<?php

namespace Database\Factories;

use App\Classes\Constants\RoleType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->regexify('[A-Z]{2}[0-9]{5}'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'name' => $this->faker->name(),
            'role_type' => $this->faker->numberBetween($min = 1, $max = 3),
            'phone_no' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    public function student()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => $this->faker->regexify('[A-Z]{2}[0-9]{5}'),
                'role_type' => RoleType::STUDENT,
            ];
        });

    }

    public function supervisor()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => $this->faker->regexify('[A-Z]{4}[0-9]{4}'),
                'role_type' => RoleType::SUPERVISOR,
            ];
        });
    }

    public function coordinator()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => $this->faker->regexify('[A-Z]{4}[0-9]{4}'),
                'role_type' => RoleType::COORDINATOR,
            ];
        });
    }

    public function technician()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => $this->faker->regexify('[A-Z]{4}[0-9]{4}'),
                'role_type' => RoleType::TECHNICIAN,
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
