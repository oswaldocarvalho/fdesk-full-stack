<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Resposta padronizada para todos os requests da api
     *
     * @param string $message
     * @param int $status
     * @param string|null $token
     * @param null $data
     * @return JsonResponse
     */
    public function jsonResonse(string $message, int $status=200, string $token=null, $data = null): JsonResponse
    {
        $responseData = [
            "message" => $message
        ];

        if ($token)
        {
            $responseData["token"] = $token;
        }

        if ($data)
        {
            $responseData["data"] = $data;
        }

        return response()->json($responseData, $status);
    }

    /**
     * Valida o request e retorna apenas os campos especificados na validação
     *
     * @param Request $request
     * @param array $rules
     * @return array
     */
    public function validate(Request $request, array $rules):object
    {
        //
        $request->validate($rules);

        //
        return (object)$request->only(array_keys($rules));
    }
}
