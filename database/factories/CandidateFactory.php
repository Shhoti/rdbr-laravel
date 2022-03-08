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
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'position' => $this->faker->jobTitle(),
            'min_salary' => $this->faker->optional($weight = 0.5)->numberBetween(1000,2000),
            'max_salary' => $this->faker->optional($weight = 0.5)->numberBetween(2000,5000),
            'linkedin_url' => $this->faker->url()
        ];
    }
}
