<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;

class DeleteUser
{

    public function handle(User $user)
    {
        try {
            $user->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'boolean'],
        ];
    }

    public function __invoke(User $user, Request $request)
    {
        abort_if(!auth()->user()->hasRole('super-admin'),401);

        try {
            if ($this->handle($user)) {
                flash()->addSuccess('Usuário deletado com sucesso.');
            } else {
                flash()->addSuccess('Usuário deletado com sucesso.');
            }
        } catch (\Throwable $th) {
            flash()->addError('Erro ao deletar usuário do usuario');
        }
        return \redirect()->back();
    }
}
