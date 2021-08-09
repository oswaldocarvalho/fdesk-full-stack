<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, UserService $userService)
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
