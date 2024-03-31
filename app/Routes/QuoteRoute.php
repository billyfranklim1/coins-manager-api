<?php

namespace App\Routes;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *      path="/api/quotes/default",
 *      summary="Recupera lista de cotações com paginação padrão",
 *      description="Retorna uma lista paginada de cotações. Por padrão, a paginação é configurada para 10 itens por página, incluindo detalhes como preço em USD, capitalização de mercado, volume nas últimas 24 horas, variação percentual nas últimas 24 horas e timestamp.",
 *      operationId="getQuotesWithDefaultPagination",
 *      tags={"Cotações"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Lista de cotações obtida com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="data", type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example="1"),
 *                      @OA\Property(property="coin", type="string", example="Bitcoin"),
 *                      @OA\Property(property="price_usd", type="number", format="float", example="50000.00"),
 *                      @OA\Property(property="market_cap", type="number", format="float", example="920000000000.00"),
 *                      @OA\Property(property="volume_24h", type="number", format="float", example="21000000000.00"),
 *                      @OA\Property(property="percent_change_24h", type="number", format="float", example="-1.2"),
 *                      @OA\Property(property="timestamp", type="string", format="date-time", example="2024-03-31T12:00:00Z")
 *                  )
 *              ),
 *              @OA\Property(property="links", type="object"),
 *              @OA\Property(property="meta", type="object")
 *          )
 *      )
 *  ),
 * @OA\Get(
 *      path="/api/quotes/custom",
 *      summary="Recupera lista de cotações com paginação customizada",
 *      description="Permite ao usuário especificar o número de itens por página através do parâmetro 'per_page'. Retorna detalhes das cotações incluindo preço em USD, capitalização de mercado, volume nas últimas 24 horas, variação percentual nas últimas 24 horas e timestamp.",
 *      operationId="getQuotesWithCustomPagination",
 *      tags={"Cotações"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="per_page",
 *          in="query",
 *          description="Número de itens por página",
 *          required=false,
 *          @OA\Schema(
 *              type="integer",
 *              default=10
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Lista de cotações com paginação customizada obtida com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="data", type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example="1"),
 *                      @OA\Property(property="coin", type="string", example="Bitcoin"),
 *                      @OA\Property(property="price_usd", type="number", format="float", example="50000.00"),
 *                      @OA\Property(property="market_cap", type="number", format="float", example="920000000000.00"),
 *                      @OA\Property(property="volume_24h", type="number", format="float", example="21000000000.00"),
 *                      @OA\Property(property="percent_change_24h", type="number", format="float", example="-1.2"),
 *                      @OA\Property(property="timestamp", type="string", format="date-time", example="2024-03-31T12:00:00Z")
 *                  )
 *              ),
 *              @OA\Property(property="links", type="object"),
 *              @OA\Property(property="meta", type="object")
 *          )
 *      )
 *  )
 *
 *
 *
 */


class QuoteRoute
{

}
