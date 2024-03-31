<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CoinService;

class CoinController extends Controller
{

    protected CoinService $coinService;

    public function __construct(CoinService $coinService)
    {
        $this->coinService = $coinService;
    }

    public function listAll(Request $request)
    {
        $params = $request->all();
        $coins = $this->coinService->listAll($params);
        return response()->json($coins);
    }

    public function listCoinsWithRecentQuotes(Request $request)
    {
        $params = $request->all();
        $coins = $this->coinService->listCoinsWithRecentQuotes($params);
        return response()->json($coins);
    }

}
