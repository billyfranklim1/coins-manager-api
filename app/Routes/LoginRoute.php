<?php

namespace App\Routes;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *      path="/api/auth/login",
 *      summary="Autentica um usuário",
 *      description="Realiza a autenticação do usuário através do email e senha e retorna um token de acesso.",
 *      operationId="loginUser",
 *      tags={"Autenticação"},
 *      @OA\RequestBody(
 *          description="Credenciais do usuário",
 *          required=true,
 *          @OA\JsonContent(
 *              required={"email","password"},
 *              @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 *              @OA\Property(property="password", type="string", format="password", example="password")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Autenticação bem-sucedida",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="token", type="string", example="2|nL7nCaYJvY8IjFSpH5qTkGFljKt1n2v8x5uHEgJh")
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Dados inválidos"
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Não autorizado - Credenciais inválidas ou expiradas"
 *      )
 *  )
 *
 * @OA\Post(
 *      path="/api/auth/register",
 *      summary="Registra um novo usuário",
 *      description="Cria um novo usuário com nome, email e senha e retorna um token de acesso.",
 *      operationId="registerUser",
 *      tags={"Autenticação"},
 *      @OA\RequestBody(
 *          description="Dados do novo usuário",
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name", "email", "password", "password_confirmation"},
 *              @OA\Property(property="name", type="string", example="John Doe"),
 *              @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *              @OA\Property(property="password", type="string", format="password", example="password"),
 *              @OA\Property(property="password_confirmation", type="string", format="password", example="password")
 *          )
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Usuário registrado com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="token", type="string", example="3|sK5DlHCxRZ7zXgJQpq6SL9xFoHrjZnS7y5uHEgJk")
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Dados inválidos"
 *      )
 *  )
 *
 * @OA\Post(
 *      path="/api/auth/logout",
 *      summary="Desconecta o usuário",
 *      description="Invalida o token de acesso atual do usuário.",
 *      operationId="logoutUser",
 *      tags={"Autenticação"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=204,
 *          description="Desconectado com sucesso"
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Não autorizado"
 *      )
 *  )
 *
 * @OA\Post(
 *      path="/api/auth/refresh",
 *      summary="Atualiza o token de acesso do usuário",
 *      description="Atualiza o token de acesso do usuário, fornecendo um novo.",
 *      operationId="refreshToken",
 *      tags={"Autenticação"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Token atualizado com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="token", type="string", example="4|u8x9w4k31s0XvYlapE3ft5MnOZCvy34X9n2PQyzM")
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Não autorizado"
 *      )
 *  )
 *
 * @OA\Get(
 *      path="/api/auth/user",
 *      summary="Obtém dados do usuário autenticado",
 *      description="Retorna os dados do usuário autenticado baseados no token fornecido.",
 *      operationId="getUserDetails",
 *      tags={"Autenticação"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Dados do usuário obtidos com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="user", type="object",
 *                  @OA\Property(property="name", type="string", example="John Doe"),
 *                  @OA\Property(property="email", type="string", example="john@example.com")
 *              ),
 *              @OA\Property(property="token", type="string", example="5|IjFSpH5qTkGFljKt1n2v8x5uHEgJh2|nL7nCaYJvY8")
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Não autorizado"
 *      )
 *  )
 *
 */

class LoginRoute
{

}
