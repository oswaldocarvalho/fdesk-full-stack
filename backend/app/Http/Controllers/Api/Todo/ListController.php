<?php

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Services\TodoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param TodoService $todoService
     * @return JsonResponse
     */
    public function __invoke(Request $request, TodoService $todoService):JsonResponse
    {
        //
        $todos = $todoService->listAll();

        return $this->jsonResponse(status:Response::HTTP_CREATED, data:$todos);
    }
}
