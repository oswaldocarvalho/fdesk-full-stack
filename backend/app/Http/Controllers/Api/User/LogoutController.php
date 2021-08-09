<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param UserService $userService
     * @return Response
     */
    public function __invoke(Request $request, UserService $userService): JsonResponse
    {
        //
        $userService->logout();

        // retorna o json e remove o cookie
        return $this->jsonResponse(
            "Até logo",
            Response::HTTP_OK
        )->cookie(cookie('token', null, path: "/"));
    }
}
