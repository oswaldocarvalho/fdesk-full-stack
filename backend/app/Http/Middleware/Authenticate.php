<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Override da função para verificar se o token veio por um webcookie
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param string[] ...$guards
     * @return mixed
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        // verifica se existe o cookie no request
        $token = $request->cookie('token', null);
        if ($token)
        {
            // se existir coloca ele no mesmo pipe da autenticação com o header
            $request->headers->set('Authorization', "Bearer {$token}");
        }

        //
        $this->authenticate($request, $guards);

        return $next($request);
    }
}
