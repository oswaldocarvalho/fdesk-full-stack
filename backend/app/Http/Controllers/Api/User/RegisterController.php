<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param UserService $userService
     * @return JsonResponse
     */
    public function __invoke(Request $request, UserService $userService):JsonResponse
    {
        // validation rules
        $requestData = $this->validateAndGetData($request, [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        //
        $userService->register($requestData->name, $requestData->email, $requestData->password);

        return $this->jsonResponse("Usuário criado com sucesso", Response::HTTP_CREATED);
    }
}
