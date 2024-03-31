<?php

namespace App\Repositories;

use App\Contracts\ICoinRepository;
use App\Models\Coin;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CoinRepository implements ICoinRepository
{
    protected Coin $model;

    public function __construct(Coin $coin)
    {
        $this->model = $coin;
    }

    public function findOrCreateByNameAndSymbol($name, $symbol): Coin
    {
        return $this->model->firstOrCreate(['name' => $name, 'symbol' => $symbol]);
    }

    public function save(array $attributes) : Coin
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function listAll(array $params): LengthAwarePaginator
    {
        return $this->model->paginate($params['per_page'] ?? 10);
    }

    public function listCoinsWithRecentQuotes(array $params) : LengthAwarePaginator
    {
        $coins = $this->model->paginate($params['per_page'] ?? 10);
        $coins->each(function ($coin) {
            $coin->setAttribute('quotes', $coin->getRecentQuotes());
        });
        return $coins;
    }

}
