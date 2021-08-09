<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Resposta padronizada para todos os requests da api
     *
     * @param string|null $message
     * @param int $status
     * @param null $data
     * @return Response|JsonResponse
     */
    public function jsonResponse(string $message=null, int $status=200, $data = null): JsonResponse
    {
        //
        $responseData = [];

        //
        if ($message)
        {
            $responseData["message"] = $message;
        }

        //
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
     * @return object
     */
    public function validateAndGetData(Request $request, array $rules):object
    {
        //
        $request->validate($rules);

        return (object)$request->only(array_keys($rules));
    }
}
