<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Dictation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DictationResult>
 */
class DictationResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $dictationIds = Dictation::pluck('id')->toArray();

        return [
            'user_id' => fake()->randomElement($userIds),
            'dictation_id' => fake()->randomElement($dictationIds),
            'text_result' => fake()->text,
            'date_time_result' => fake()->dateTimeBetween(),
        ];
    }
}
