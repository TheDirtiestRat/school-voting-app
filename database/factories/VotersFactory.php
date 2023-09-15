<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voters>
 */
class VotersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'USN' => fake()->numerify('#########'),
            'name' => fake()->name(),
            'program' => fake()->randomElement([
                'BSIT',
                'BSCS',
                'BHSM',
                'TVL',
            ]),
            'year' => fake()->year(),
            'school_level' => fake()->randomElement([
                'College',
                'Senior High',
            ]),
            'isVoted' => "not yet",
        ];
    }
}
