<?php

namespace App\Contracts;

interface ICoinRepository
{
    public function save(array $attributes);
    public function listAll(array $params);
    public function listCoinsWithRecentQuotes(array $params);
}
