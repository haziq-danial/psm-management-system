<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TitleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'std_id' => 0,
            'sv_id' => 0,
            'psm_title' => $this->faker->realText('40','5')
        ];
    }
}
