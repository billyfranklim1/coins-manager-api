<?php

namespace App\Routes;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *      path="/api/coins",
 *      summary="Recupera lista de moedas com paginação padrão",
 *      description="Retorna uma lista paginada de moedas, incluindo id, nome e símbolo de cada moeda, com paginação padrão de 10 itens por página.",
 *      operationId="getCoins",
 *      tags={"Moedas"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Lista de moedas recuperada com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="data", type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example="1"),
 *                      @OA\Property(property="name", type="string", example="Bitcoin"),
 *                      @OA\Property(property="symbol", type="string", example="BTC")
 *                  )
 *              ),
 *              @OA\Property(property="links", type="object",
 *                  @OA\Property(property="first", type="string", example="http://api.example.com/api/coins?page=1"),
 *                  @OA\Property(property="last", type="string", example="http://api.example.com/api/coins?page=10"),
 *                  @OA\Property(property="prev", type="string", example=null),
 *                  @OA\Property(property="next", type="string", example="http://api.example.com/api/coins?page=2")
 *              ),
 *              @OA\Property(property="meta", type="object",
 *                  @OA\Property(property="current_page", type="integer", example="1"),
 *                  @OA\Property(property="from", type="integer", example="1"),
 *                  @OA\Property(property="last_page", type="integer", example="10"),
 *                  @OA\Property(property="path", type="string", example="http://api.example.com/api/coins"),
 *                  @OA\Property(property="per_page", type="integer", example="10"),
 *                  @OA\Property(property="to", type="integer", example="10"),
 *                  @OA\Property(property="total", type="integer", example="100")
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Não autorizado"
 *      )
 *  ),
 *
 *
 * @OA\Get(
 *      path="/api/coins/coins-with-recent-quotes",
 *      summary="Recupera moedas com as cotações mais recentes",
 *      description="Retorna uma lista paginada de moedas, incluindo id, nome, símbolo e suas cotações mais recentes.",
 *      operationId="getCoinsWithRecentQuotes",
 *      tags={"Moedas"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Moedas com cotações recentes recuperadas com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="data", type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example="1"),
 *                      @OA\Property(property="name", type="string", example="Bitcoin"),
 *                      @OA\Property(property="symbol", type="string", example="BTC"),
 *                      @OA\Property(property="quotes", type="array",
 *                          @OA\Items(
 *                              @OA\Property(property="id", type="integer", example="101"),
 *                              @OA\Property(property="coin_id", type="integer", example="1"),
 *                              @OA\Property(property="price_usd", type="number", format="float", example="50000.00"),
 *                              @OA\Property(property="market_cap", type="number", format="float", example="920000000000.00"),
 *                              @OA\Property(property="volume_24h", type="number", format="float", example="21000000000.00"),
 *                              @OA\Property(property="percent_change_24h", type="number", format="float", example="-1.2"),
 *                              @OA\Property(property="timestamp", type="string", format="date-time", example="2024-03-31T12:00:00Z")
 *                          )
 *                      )
 *                  )
 *              ),
 *              @OA\Property(property="links", type="object"),
 *              @OA\Property(property="meta", type="object")
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Não autorizado"
 *      )
 *  )
 */


class CoinRoute
{

}
