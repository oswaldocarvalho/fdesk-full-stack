<?php


namespace App\Services;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TodoService
{
    private User $user;

    /**
     * TodoService constructor.
     */
    public function __construct()
    {
        $this->user = Auth::guard("api")->user();
    }

    public function listAll()
    {
        return Todo::where('user_id', $this->user->id)->orderBy('id')->get();
    }

    public function add(string $todo):Todo
    {
        return $this->user->todos()->create([
            'todo' => $todo
        ]);
    }

    public function update(int $id, string $todo):void
    {
        $affectedRows = $this->user->todos()->where('id', $id)->update([
            'todo' => $todo
        ]);

        if ($affectedRows==0)
        {
            throw new HttpException( Response::HTTP_NOT_FOUND, "Registro não encontrado");
        }
    }

    public function delete(int $id):void
    {
        $affectedRows = $this->user->todos()->where('id', $id)->delete();

        if ($affectedRows==0)
        {
            throw new HttpException( Response::HTTP_NOT_FOUND, "Registro não encontrado");
        }
    }

    public function toggleCompleted(int $id):object
    {
        $completed = null;

        try
        {
            DB::beginTransaction();

            $todo = $this->user->todos()->where('id', $id)->first();

            if ($todo==null)
            {
                throw new HttpException( Response::HTTP_NOT_FOUND, "Registro não encontrado");
            }

            $completed = $todo->completed_at == null ? now() : null;
            $todo->update([
                'completed_at' => $completed
            ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpException( Response::HTTP_INTERNAL_SERVER_ERROR, "Erro ao atualizar o registro");
        }

        return (object)['completed' => $completed!==null];
    }
}
