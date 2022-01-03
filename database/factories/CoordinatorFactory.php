<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CoordinatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 0,
            'staff_id' => 'none',
            'faculty' => 'FKOM',
            'office_no' => 'A-2-10'
        ];
    }
}
