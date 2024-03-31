<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CryptoService;
use App\Models\Coin;

class FetchCryptoData extends Command
{
    protected $signature = 'crypto:fetch';
    protected $description = 'Fetches cryptocurrency data for given symbols.';

    private $cryptoService;

    public function __construct(CryptoService $cryptoService)
    {
        parent::__construct();
        $this->cryptoService = $cryptoService;
    }

    public function handle()
    {

        $symbols = Coin::all()->pluck('symbol')->toArray();

        if (empty($symbols)) {
            $this->error('Please provide at least one symbol.');
            return 1;
        }

        $success = $this->cryptoService->fetchAndProcessData($symbols);

        if ($success) {
            $this->info('Data successfully fetched and processed.');
        } else {
            $this->error('Failed to fetch and process data.');
            return 1;
        }

        return 0;
    }
}
