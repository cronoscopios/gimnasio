<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => Str::title($name),
            'slug' => Str::slug($name),
            'summary' => fake()->sentence(),
            'description' => fake()->paragraphs(3, true),
            'level' => fake()->randomElement(['Todos los niveles', 'Iniciación', 'Intermedio', 'Avanzado']),
            'duration_minutes' => fake()->randomElement([45, 50, 60]),
            'sort_order' => 0,
        ];
    }
}
