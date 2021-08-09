<?php

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Services\TodoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $id
     * @param TodoService $todoService
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $id, TodoService $todoService): JsonResponse
    {
        //
        $todoService->delete($id);

        return $this->jsonResponse("Removido com sucesso", status:Response::HTTP_OK);
    }
}
