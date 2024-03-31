<?php

namespace App\Services;
use App\Contracts\ICoinRepository;

class CoinService
{
    protected ICoinRepository $coinRepository;

    public function __construct(ICoinRepository $coinRepository)
    {
        $this->coinRepository = $coinRepository;
    }

    public function listAll(array $params)
    {
        return $this->coinRepository->listAll($params);
    }

    public function listCoinsWithRecentQuotes(array $params)
    {
        return $this->coinRepository->listCoinsWithRecentQuotes($params);
    }

}
