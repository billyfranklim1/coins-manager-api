<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\User;
use App\Models\Coin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        Group::factory()->count(15)->create();
    }

    private function createCoins(int $count = 5)
    {
        return Coin::factory()->count($count)->create();
    }

    public function test_lists_all_groups()
    {
        $response = $this->getJson('/api/groups');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'coins',
                    ]
                ],
                'links',
                'meta',
            ]);
    }

    public function test_creates_a_group()
    {
        $coins = $this->createCoins();

        $response = $this->postJson('/api/groups', [
            'name' => 'Group Test',
            'description' => 'Description Test',
            'coins' => $coins->pluck('id')->toArray(),
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'description',
                    'coins',
                ]
            ]);

        $this->assertDatabaseHas('groups', [
            'name' => 'Group Test',
            'description' => 'Description Test',
        ]);

        foreach ($coins as $coin) {
            $this->assertDatabaseHas('group_coins', [
                'coin_id' => $coin->id,
            ]);
        }
    }

    public function test_fails_to_create_a_group_without_name()
    {
        $response = $this->postJson('/api/groups', [
            'description' => 'Missing name',
            'coins' => [],
        ]);

        $response->assertStatus(422);
    }

    public function test_shows_a_group()
    {
        $group = Group::first();
        $response = $this->getJson("/api/groups/{$group->id}");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'coins',
            ]
        ]);

        $response->assertJson([
            'data' => [
                'id' => $group->id,
                'name' => $group->name,
                'description' => $group->description,
            ]
        ]);
    }

    public function test_updates_a_group()
    {
        $group = Group::first();
        $coins = Coin::factory()->count(5)->create();

        $response = $this->putJson("/api/groups/{$group->id}", [
            'name' => 'Group Test Updated',
            'description' => 'Desc200,ription Test Updated',
            'coins' => $coins->pluck('id'),
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'coins',
            ]
        ]);
    }

    public function test_deletes_a_group()
    {
        $group = Group::factory()->create();
        $response = $this->deleteJson("/api/groups/{$group->id}");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);


        $this->assertDatabaseMissing('groups', [
            'id' => $group->id,
        ]);
    }

    public function test_add_coins_to_a_group()
    {
        $group = Group::first();
        $coin = Coin::factory()->create();

        $response = $this->postJson("/api/groups/{$group->id}/coins", [
            'coin_id' => $coin->id,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Coin added to the group successfully.',
                'status' => 'success'
            ]);

        $this->assertDatabaseHas('group_coins', [
            'coin_id' => $coin->id,
            'group_id' => $group->id,
        ]);
    }

    public function test_remove_coins_from_a_group()
    {
        $group = Group::first();
        $coin = Coin::factory()->create();

        $response = $this->deleteJson("/api/groups/{$group->id}/coins", [
            'coin_id' => $coin->id,
        ]);
        $response->assertStatus(200)->assertJson([
            'message' => 'Coin removed from the group successfully.',
            'status' => 'success'
        ]);

        $response->assertJsonStructure([
            'message',
            'status'
        ]);

        $this->assertDatabaseMissing('group_coins', [
            'coin_id' => $coin->id,
            'group_id' => $group->id,
        ]);
    }


}
