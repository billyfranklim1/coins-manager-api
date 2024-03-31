<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Quote;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class CoinTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        Quote::factory()->count(50)->create();
    }


    public function test_user_can_retrieve_coins_with_default_pagination()
    {
        $response = $this->getJson('/api/coins');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'symbol'
                    ]
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total',
            ]);

        $this->assertCount(10, $response->json('data'));
    }

    public function test_user_can_retrieve_coins_with_recent_quotes()
    {
        $response = $this->getJson('/api/coins/coins-with-recent-quotes');


        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'symbol', 'quotes' => [
                            '*' => [
                                'id', 'coin_id', 'price_usd', 'market_cap', 'volume_24h', 'percent_change_24h', 'timestamp',
                            ]
                        ]
                    ]
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total',
            ]);

        $this->assertCount(10, $response->json('data'));
    }
}
