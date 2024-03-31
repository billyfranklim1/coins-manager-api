<?php

namespace App\Contracts;

use Illuminate\Http\Client\Response;
use Exception;

interface HttpClientInterface
{
    public function get(string $url, array $query = [], array $headers = []): Response | Exception;
}
