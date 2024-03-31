<?php
namespace Database\Factories;

use App\Models\Coin;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoinFactory extends Factory
{
    protected $model = Coin::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'symbol' => $this->faker->unique()->lexify('???'),
        ];
    }
}
