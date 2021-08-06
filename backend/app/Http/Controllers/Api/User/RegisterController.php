<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // validation rules
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        //
        $request->validate($rules);

        //
        $data = $request->only(array_keys($rules));

        // TODO: Criar uma camada de serviços com as regras de negócio entre o model e o controller
        $data['password'] = Hash::make($data['password']);
        User::create($data);

        //
        return $this->jsonResonse("Usuário criado com sucesso", Response::HTTP_CREATED);
    }
}
