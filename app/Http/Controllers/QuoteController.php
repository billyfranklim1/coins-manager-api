<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuoteService;
use App\Http\Resources\QuoteResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class QuoteController extends Controller
{

    protected QuoteService $quoteService;

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $params = $request->all();
        $quotes = $this->quoteService->listAll($params);
        return QuoteResource::collection($quotes);
    }

}
