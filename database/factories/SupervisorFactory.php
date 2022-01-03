<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupervisorFactory extends Factory
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
            'expertise' => 'Software Eng.',
            'office_no' => 'A-2-10'
        ];
    }
}
