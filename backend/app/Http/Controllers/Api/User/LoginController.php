<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
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
    public function __invoke(Request $request)
    {
        $rules = [
            'email' => 'required|string',
            'password' => 'required|min:6',
        ];

        //
        $request->validate($rules);

        //
        $data = $request->only(array_keys($rules));

        //
        $user = User::where('email', $data['email'])->first();

        if ($user==null || !auth()->attempt($data))
        {
            throw new HttpException( Response::HTTP_UNAUTHORIZED, "Usuário e/ou senha inválido(s)");
        }

        //
        $token = auth()->user()->createToken('authToken')->accessToken;

        return $this->jsonResonse("Seja bem-vindo {$user->name}!", Response::HTTP_OK, $token, auth()->user());
    }
}
