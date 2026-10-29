<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\ScheduledClass;
use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ScheduledClass>
 */
class ScheduledClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startHour = fake()->numberBetween(7, 21);

        return [
            'activity_id' => Activity::factory(),
            'trainer_id' => Trainer::factory(),
            'day_of_week' => fake()->numberBetween(1, 7),
            'starts_at' => sprintf('%02d:00', $startHour),
            'ends_at' => sprintf('%02d:00', $startHour + 1),
            'room' => fake()->randomElement(['Sala 1', 'Sala 2', 'Sala de ciclo']),
        ];
    }
}
