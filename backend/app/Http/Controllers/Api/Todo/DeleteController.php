<?php

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $id, TodoService $todoService)
    {
        //
        $todoService->delete($id);

        return $this->jsonResponse("Removido com sucesso", status:Response::HTTP_OK);
    }
}
