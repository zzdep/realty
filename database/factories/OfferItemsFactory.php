<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OfferItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $square = random_int(330, 2000) / 10;
        return [
            'offer_id' => random_int(1, 10),
            'cid' => Str::uuid(),
            'type' => 'Евродвушка',
            'square' => $square,
            'price' => round($square * random_int(200, 300)) * 1000,
            'complex' => 'ЖК «'.fake()->streetName().'»',
            'house' => 'ГП'.random_int(50, 99).'.'.random_int(1, 10).'-'.random_int(10, 20),
            'description' => fake()->text(),
            'images' => [fake()->imageUrl(), fake()->imageUrl(), fake()->imageUrl()],
            'like' => fake()->boolean(),
        ];
    }
}
