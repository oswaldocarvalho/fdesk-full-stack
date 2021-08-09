<?php

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TodoService $todoService)
    {
        //
        $todos = $todoService->listAll();

        return $this->jsonResponse(status:Response::HTTP_CREATED, data:$todos);
    }
}
