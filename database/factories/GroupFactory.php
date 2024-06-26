<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use App\Models\Coin;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'user_id' => User::factory(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Group $group) {
            $coins = Coin::factory()->count(rand(1, 5))->create();
            $group->coins()->attach($coins);
        });
    }
}
