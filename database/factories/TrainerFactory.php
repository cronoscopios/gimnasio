<?php

namespace Database\Factories;

use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trainer>
 */
class TrainerFactory extends Factory
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
            'specialty' => fake()->randomElement(['Entrenamiento funcional', 'Halterofilia', 'Gimnásticos', 'Movilidad']),
            'bio' => fake()->paragraph(),
            'qualifications' => fake()->sentence(),
            'photo_path' => null,
            'sort_order' => 0,
        ];
    }
}
