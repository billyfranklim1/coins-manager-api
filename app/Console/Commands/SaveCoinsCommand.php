<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Coin;

class SaveCoinsCommand extends Command
{
    protected $signature = 'coin:save';
    protected $description = 'Saves cryptocurrencies to the database.';

    public function handle()
    {
        $limit = 100;
        $response = Http::get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/map', [
            'limit' => $limit,
            'sort' => 'cmc_rank',
            'CMC_PRO_API_KEY' => env('COIN_MARKET_CAP_API_KEY'),
        ]);

        if ($response->successful()) {
            $coins = $response->json()['data'];
            foreach ($coins as $coin) {
                Coin::updateOrCreate(
                    ['id' => $coin['id']],
                    ['name' => $coin['name'], 'symbol' => $coin['symbol']]
                );
            }

            $this->info("Successfully saved {$limit} coins.");
        } else {
            $this->error("Failed to fetch coins: " . $response->body());
        }
    }
}
