<?php

namespace Database\Factories;

use App\Enums\AdsConst;
use App\Models\Advertiser;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement([AdsConst::FREE, AdsConst::PAID]),
            'title' => $this->faker->name,
            'description' => $this->faker->sentence(),
            'start_date' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'category_id' => Category::factory()->create()->id,
            'advertiser_id' => Advertiser::factory()->create()->id,
        ];
    }
}
