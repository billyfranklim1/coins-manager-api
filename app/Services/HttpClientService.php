<?php

namespace App\Services;

use App\Contracts\HttpClientInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Exception;

class HttpClientService implements HttpClientInterface
{
    public function get(string $url, array $query = [], array $headers = []): Response | Exception
    {
        return Http::withHeaders($headers)->get($url, $query);
    }
}
