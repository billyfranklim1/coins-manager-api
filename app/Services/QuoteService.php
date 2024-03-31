<?php

namespace App\Services;
use App\Contracts\IQuoteRepository;

class QuoteService
{
    protected IQuoteRepository $quoteRepository;

    public function __construct(IQuoteRepository $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }

    public function listAll(array $params)
    {
        return $this->quoteRepository->listAll($params);
    }

}
