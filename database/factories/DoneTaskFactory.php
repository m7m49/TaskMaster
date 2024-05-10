<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DoneTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 25,
            'title' => fake()->title(),
            'description' => fake()->text(),
            'priority' => fake()->word(),
            'deadline' => fake()->dateTime(),
            'done_at' => fake()->dateTime(),
            'status' => fake()->word(),
        ];
    }
}