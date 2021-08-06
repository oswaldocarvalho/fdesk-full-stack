<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $message
     * @param int $status
     * @param string|null $token
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResonse(string $message, int $status=200, string $token=null, $data = null): \Illuminate\Http\JsonResponse
    {
        $response = [
            "message" => $message
        ];

        if ($data)
        {
            $response["data"] = $data;
        }

        if ($token)
        {
            $response["token"] = $token;
        }

        return response()->json($response, $status);
    }
}
