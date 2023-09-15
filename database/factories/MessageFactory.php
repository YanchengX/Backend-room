<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_at' => random_int(1,10),
            'user' => random_int(1,30),
            'content' => fake()->text(44),
            'sent_time' => fake()->time(now()),
        ];
    }
}
