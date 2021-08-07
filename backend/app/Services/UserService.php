<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserService
{
    /**
     * Efetua login gerando um token
     *
     * @param string $email
     * @param string $password
     * @return object
     */
    public function login(string $email, string $password): object
    {
        //
        $user = User::where('email', $email)->first();

        if ($user==null || !auth()->attempt(['email' => $email, 'password' => $password]))
        {
            throw new HttpException( Response::HTTP_UNAUTHORIZED, "Usuário e/ou senha inválido(s)");
        }

        //
        $token = auth()->user()->createToken('authToken')->accessToken;

        return (object)[
            'token' => $token,
            'user' => $user
        ];
    }

    /**
     * Registra um novo usuário no sistema
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function register(string $name, string $email, string $password):User
    {
        //
        $password = Hash::make($password);

        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }

    /**
     * Revoga o token do usuário
     *
     * @return void
     */
    public function logout():void
    {
        $user = Auth::guard("api")->user()->token();
        $user->revoke();
    }
}
