<?php

namespace App\Routes;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *      path="/api/groups",
 *      summary="Lista todos os grupos",
 *      description="Retorna uma lista de todos os grupos disponíveis, incluindo informações detalhadas e suas moedas associadas.",
 *      operationId="listAllGroups",
 *      tags={"Grupos"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Lista de grupos obtida com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="data", type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example="1"),
 *                      @OA\Property(property="name", type="string", example="Grupo de Teste"),
 *                      @OA\Property(property="description", type="string", example="Descrição do Grupo de Teste"),
 *                      @OA\Property(property="coins", type="array",
 *                          @OA\Items(
 *                              @OA\Property(property="id", type="integer", example="1"),
 *                              @OA\Property(property="name", type="string", example="Bitcoin"),
 *                              @OA\Property(property="symbol", type="string", example="BTC")
 *                          )
 *                      )
 *                  )
 *              ),
 *              @OA\Property(property="links", type="object"),
 *              @OA\Property(property="meta", type="object")
 *          )
 *      )
 *  ),
 * @OA\Post(
 *      path="/api/groups",
 *      summary="Cria um novo grupo",
 *      description="Cria um novo grupo com um conjunto específico de moedas.",
 *      operationId="createGroup",
 *      tags={"Grupos"},
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *          description="Dados do novo grupo",
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name", "description", "coins"},
 *              @OA\Property(property="name", type="string", example="Grupo de Teste"),
 *              @OA\Property(property="description", type="string", example="Descrição do Grupo de Teste"),
 *              @OA\Property(property="coins", type="array",
 *                  @OA\Items(type="integer", example="1")
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Grupo criado com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example="1"),
 *                  @OA\Property(property="name", type="string", example="Grupo de Teste"),
 *                  @OA\Property(property="description", type="string", example="Descrição do Grupo de Teste"),
 *                  @OA\Property(property="coins", type="array",
 *                      @OA\Items(
 *                          @OA\Property(property="id", type="integer", example="1"),
 *                          @OA\Property(property="name", type="string", example="Bitcoin"),
 *                          @OA\Property(property="symbol", type="string", example="BTC")
 *                      )
 *                  )
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Dados inválidos fornecidos"
 *      )
 *  ),
 * @OA\Get(
 *      path="/api/groups/{groupId}",
 *      summary="Exibe detalhes de um grupo específico",
 *      description="Retorna os detalhes de um grupo específico, incluindo suas moedas associadas.",
 *      operationId="showGroupDetails",
 *      tags={"Grupos"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="groupId",
 *          in="path",
 *          required=true,
 *          description="ID do grupo",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Detalhes do grupo obtidos com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example="1"),
 *                  @OA\Property(property="name", type="string", example="Grupo de Teste"),
 *                  @OA\Property(property="description", type="string", example="Descrição do Grupo de Teste"),
 *                  @OA\Property(property="coins", type="array",
 *                      @OA\Items(
 *                          @OA\Property(property="id", type="integer", example="1"),
 *                          @OA\Property(property="name", type="string", example="Bitcoin"),
 *                          @OA\Property(property="symbol", type="string", example="BTC")
 *                      )
 *                  )
 *              )
 *          )
 *      )
 *  ),
 * @OA\Put(
 *      path="/api/groups/{groupId}",
 *      summary="Atualiza um grupo existente",
 *      description="Atualiza os detalhes de um grupo existente, permitindo modificar o nome, descrição e as moedas associadas.",
 *      operationId="updateGroup",
 *      tags={"Grupos"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="groupId",
 *          in="path",
 *          required=true,
 *          description="ID do grupo para atualização",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          description="Dados para atualização do grupo",
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name", "description", "coins"},
 *              @OA\Property(property="name", type="string", example="Grupo Atualizado"),
 *              @OA\Property(property="description", type="string", example="Descrição Atualizada"),
 *              @OA\Property(property="coins", type="array",
 *                  @OA\Items(type="integer", example="2")
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Grupo atualizado com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example="1"),
 *                  @OA\Property(property="name", type="string", example="Grupo Atualizado"),
 *                  @OA\Property(property="description", type="string", example="Descrição Atualizada"),
 *                  @OA\Property(property="coins", type="array",
 *                      @OA\Items(
 *                          @OA\Property(property="id", type="integer", example="2"),
 *                          @OA\Property(property="name", type="string", example="Ethereum"),
 *                          @OA\Property(property="symbol", type="string", example="ETH")
 *                      )
 *                  )
 *              )
 *          )
 *      )
 *  ),
 * @OA\Delete(
 *      path="/api/groups/{groupId}",
 *      summary="Deleta um grupo",
 *      description="Remove um grupo existente e todas as suas associações de moedas.",
 *      operationId="deleteGroup",
 *      tags={"Grupos"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="groupId",
 *          in="path",
 *          required=true,
 *          description="ID do grupo para deleção",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Grupo deletado com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="message", type="string", example="Grupo deletado com sucesso.")
 *          )
 *      )
 *  )
 */


class GroupRoute
{

}

