<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dictation>
 */
class DictationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence($nbWords = 3, $variableNbWords = true),
            'is_active' => fake()->boolean(),
            'description' => fake()->text($maxNbChars = 200),
            'answer' => fake()->text($maxNbChars = 1000),
            'from_date_time' => fake()->dateTimeBetween('-1 week', 'now'),
            'to_date_time' => fake()->dateTimeBetween($fromDateTime = 'now', '+1 week')
        ];
    }
}
