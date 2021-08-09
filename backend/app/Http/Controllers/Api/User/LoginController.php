<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param UserService $userService
     * @return JsonResponse
     */
    public function __invoke(Request $request, UserService $userService): JsonResponse
    {
        //
        $requestData = $this->validateAndGetData($request, [
            'email' => 'required|string',
            'password' => 'required|min:6',
        ]);

        //
        $loginResult = $userService->login($requestData->email, $requestData->password);

        // cria um HttpOnly cookie no response para o react
        return $this->jsonResponse(
            "Seja bem-vindo {$loginResult->user->name}!",
            Response::HTTP_OK,
            array_merge($loginResult->user->toArray(), [$loginResult->token])
        )->cookie(cookie('token', $loginResult->token, path: "/", secure: (env("APP_ENV")!='local'), httpOnly: true));
    }
}
