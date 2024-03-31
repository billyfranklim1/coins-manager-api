<?php

namespace App\Repositories;

use App\Contracts\ICoinRepository;
use App\Models\Coin;

class CoinRepository implements ICoinRepository
{
    protected Coin $model;

    public function __construct(Coin $coin)
    {
        $this->model = $coin;
    }

    public function findOrCreateByNameAndSymbol($name, $symbol)
    {
        return $this->model->firstOrCreate(['name' => $name, 'symbol' => $symbol]);
    }

    public function save(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function listAll(array $params)
    {
        return $this->model->paginate($params['per_page'] ?? 10);
    }

    public function listCoinsWithRecentQuotes(array $params)
    {
        $coins = $this->model->paginate($params['per_page'] ?? 10);
        $coins->each(function ($coin) {
            $coin->quotes = $coin->quotes()->latest()->take(50)->get();
        });

        return $coins;
    }

}
