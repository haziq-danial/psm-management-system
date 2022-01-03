<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProposalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title_id' => 0,
            'objective' => 'none',
            'scope_of_project' => 'none',
            'problem_background' => 'none',
            'techniques' => 'none',
            'status_approval' => 'none'
        ];
    }
}
