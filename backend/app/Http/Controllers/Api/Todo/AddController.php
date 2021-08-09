<?php

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Services\TodoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddController extends Controller
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
        // validation rules
        $requestData = $this->validateAndGetData($request, [
            'todo' => 'required|string'
        ]);

        //
        $todo = $todoService->add($requestData->todo);

        return $this->jsonResponse(status:Response::HTTP_CREATED, data:$todo);
    }
}
