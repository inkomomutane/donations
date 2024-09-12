<?php

namespace App\Http\Controllers\User;

use App\Models\Scopes\ActiveUser;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteUser
{

    public function handle(User $user)
    {
        try {
            $user->active = !$user->active;
            $user->saveQuietly();
            return $user->active;
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

    public function __invoke($user, Request $request)
    {



        abort_if(!auth()->user()->hasRole('super-admin'),401);
        $user = User::withoutGlobalScope(ActiveUser::class)->whereId($user)->first();
        try {
            if ($this->handle($user)) {
                flash()->addSuccess('Usuário habilitado com sucesso.');
            } else {
                flash()->addError('Usuário desabilitado com sucesso.');
            }
        } catch (\Throwable $th) {
            flash()->addError('Erro ao habilitar/desabilitar usuário');
        }
        return \redirect()->back();
    }
}
