<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'b24_contact_id' => random_int(100, 1000),
            'b24_deal_id' => random_int(100, 1000),
            'b24_manager_id' => random_int(100, 1000),
            'manager' => fake()->name(),
            'position' => fake()->jobTitle(),
            'phone' => fake()->phoneNumber(),
            'avatar' => fake()->imageUrl(),
            'status' => random_int(1, 3),
            'date_end' => date("Y-m-d", strtotime('+'.random_int(0, 100).' days')),
            'created_at' => now(),
        ];
    }
}
