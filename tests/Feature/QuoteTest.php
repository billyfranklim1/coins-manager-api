<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Quote;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class QuoteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        Quote::factory()->count(15)->create();
    }

    public function test_user_can_retrieve_quotes_with_default_pagination()
    {
        $response = $this->getJson('/api/quotes');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'coin', 'price_usd', 'market_cap', 'volume_24h', 'percent_change_24h', 'timestamp',
                    ]
                ],
                'links', 'meta',
            ]);

        $this->assertCount(10, $response->json('data'));
    }

    public function test_user_can_retrieve_quotes_with_custom_pagination()
    {
        $perPage = 5;
        $response = $this->getJson("/api/quotes?per_page={$perPage}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'coin', 'price_usd', 'market_cap', 'volume_24h', 'percent_change_24h', 'timestamp',
                    ]
                ],
                'links', 'meta',
            ]);

        $this->assertCount($perPage, $response->json('data'));
    }

}
