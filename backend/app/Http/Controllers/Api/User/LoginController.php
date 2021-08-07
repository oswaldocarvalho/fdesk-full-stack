<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LoginController extends Controller
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
        $requestData = $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|min:6',
        ]);

        //
        $loginResult = $userService->login($requestData->email, $requestData->password);

        return $this->jsonResonse(
            "Seja bem-vindo {$loginResult->user->name}!",
            Response::HTTP_OK,
            $loginResult->token,
            $loginResult->user
        );
    }
}
