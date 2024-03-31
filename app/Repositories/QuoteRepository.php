<?php

namespace App\Repositories;

use App\Contracts\IQuoteRepository;
use App\Models\Quote;

class QuoteRepository implements IQuoteRepository
{
    protected Quote $model;

    public function __construct(Quote $model)
    {
        $this->model = $model;
    }

    public function updateOrCreateQuote($coinId, $timestamp, $data)
    {
        return $this->model->updateOrCreate(['coin_id' => $coinId, 'timestamp' => $timestamp], $data);
    }

    public function save(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function listAll(array $params)
    {
        $query = $this->model->query();

        if (isset($params['coin_id'])) {
            $query->where('coin_id', $params['coin_id']);
        }

        return $query->paginate($params['per_page'] ?? 10);
    }

}
