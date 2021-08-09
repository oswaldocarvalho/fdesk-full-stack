<?php

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TodoService $todoService)
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
