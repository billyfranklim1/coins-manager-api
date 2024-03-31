<?php

namespace App\Contracts;


interface IQuoteRepository
{
    public function save(array $attributes);
    public function updateOrCreateQuote($coinId, $timestamp, $data);
    public function listAll(array $params);

}
