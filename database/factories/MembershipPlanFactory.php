<?php

namespace Database\Factories;

use App\Models\MembershipPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MembershipPlan>
 */
class MembershipPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'description' => fake()->sentence(),
            'monthly_price_cents' => fake()->numberBetween(2500, 6000),
            'enrollment_fee_cents' => fake()->randomElement([0, 1500, 3000]),
            'commitment_months' => fake()->randomElement([null, 3, 12]),
            'features' => fake()->sentences(3),
            'is_featured' => false,
            'sort_order' => 0,
        ];
    }

    /**
     * Indicate that the plan is highlighted on the pricing page.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
