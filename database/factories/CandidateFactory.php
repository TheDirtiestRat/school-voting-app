<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'program' => fake()->randomElement([
                'BSIT',
                'BSCS',
                'BHSM',
                'TVL',
                'STUFF'
            ]),
            'position' => fake()->randomElement([
                'President',
                'Vice President',
                'Secretary',
                'Treasurer'
            ]),
            'school_level' => fake()->randomElement([
                'College',
                'Senior High',
            ]),
            'photo' => 'aclc logo.png',
        ];
    }
}
