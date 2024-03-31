<?php

namespace App\Services;

use App\Contracts\ICoinRepository;
use App\Contracts\IQuoteRepository;
use App\Contracts\HttpClientInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CryptoService
{
    protected ICoinRepository $coinRepository;
    protected IQuoteRepository $quoteRepository;
    protected HttpClientInterface $httpClient;
    private string $apiUrl;
    private string $apiKey;

    public function __construct(
        ICoinRepository     $coinRepository,
        IQuoteRepository    $quoteRepository,
        HttpClientInterface $httpClient
    )
    {
        $this->coinRepository = $coinRepository;
        $this->quoteRepository = $quoteRepository;
        $this->httpClient = $httpClient;
        $this->apiUrl = config('services.coinmarketcap.api_url');
        $this->apiKey = config('services.coinmarketcap.api_key');
    }

    public function fetchAndProcessData(array $symbols): bool
    {
        $response = $this->fetchDataFromAPI($symbols);
        $isMultipleSymbols = count($symbols) > 1;

        if ($response['data']) {
            $this->processQuotes($response['data'], $isMultipleSymbols);
            return true;
        } else {
            Log::error("Failed to fetch data from API: {$response['error']}");
            return false;
        }
    }

    private function processQuotes(array $data, bool $isMultipleSymbols): void
    {
        if ($isMultipleSymbols) {
            foreach ($data as $coins) {
                $this->saveQuote($coins);
            }
        } else {
            $this->saveQuote($data, true);
        }
    }

    private function saveQuote($coins, $singleSymbol = false): void
    {
        $quotes = $singleSymbol ? [$coins] : $coins['quotes'];

        foreach ($quotes as $quote) {

            $quoteData = $singleSymbol ? ($quote['quotes'] ?? []) : ($quote['quote']['USD'] ?? []);
            $coin = $this->coinRepository->findOrCreateByNameAndSymbol($coins['name'], $coins['symbol']);


            if ($singleSymbol) {

                foreach ($quoteData as $item) {
                    $quoteInfos = $item['quote']['USD'];
                    $timestamp = Carbon::parse($quoteInfos['timestamp'])->format('Y-m-d H:i:s');
                    $this->quoteRepository->updateOrCreateQuote($coin->id, $timestamp, [
                        'coin_id' => $coin->id,
                        'timestamp' => $timestamp,
                        'price_usd' => $quoteInfos['price'],
                        'market_cap' => $quoteInfos['market_cap'],
                        'volume_24h' => $quoteInfos['volume_24h'],
                        'percent_change_24h' => $quoteInfos['percent_change_24h'],
                    ]);
                }

            } else {

                $timestamp = Carbon::parse($quoteData['timestamp'])->format('Y-m-d H:i:s');

                $this->quoteRepository->updateOrCreateQuote($coin->id, $timestamp, [
                    'coin_id' => $coin->id,
                    'timestamp' => $timestamp,
                    'price_usd' => $quoteData['price'],
                    'market_cap' => $quoteData['market_cap'],
                    'volume_24h' => $quoteData['volume_24h'],
                    'percent_change_24h' => $quoteData['percent_change_24h'],
                ]);
            }
        }
    }

    private function fetchDataFromAPI(array $symbols): array
    {
        $uri = "$this->apiUrl/v1/cryptocurrency/quotes/historical";
        return $this->httpClient->get($uri, [
            'symbol' => implode(',', $symbols)
        ], [
            'Accept' => 'application/json',
            'X-CMC_PRO_API_KEY' => $this->apiKey,
        ])->json();
    }

}
