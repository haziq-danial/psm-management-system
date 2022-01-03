<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
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
            'sv_id' => 0,
            'matric_no' => 'none',
            'course' => 'Software Eng.',
            'faculty' => 'FKOM',
            'sem_year' => '3/ 3rd Year',
            'campus' => 'Pekan'
        ];
    }

    public function fkom()
    {
        return $this->state([
            'course' => 'Software Eng.',
            'faculty' => 'FKOM',
            'campus' => 'Pekan'
        ]);
    }
}
