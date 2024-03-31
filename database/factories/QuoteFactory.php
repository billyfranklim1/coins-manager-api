<?php

namespace Database\Factories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Coin;

class QuoteFactory extends Factory
{
    protected $model = Quote::class;

    public function definition()
    {
        return [
            'coin_id' => Coin::factory(),
            'price_usd' => $this->faker->randomFloat(2, 0, 100),
            'market_cap' => $this->faker->numberBetween(1000, 1000000),
            'volume_24h' => $this->faker->numberBetween(100, 10000),
            'percent_change_24h' => $this->faker->randomFloat(2, -100, 100),
            'timestamp' => $this->faker->dateTimeThisYear(),
        ];
    }
}
