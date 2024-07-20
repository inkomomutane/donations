<?php

namespace App\Http\Controllers\User;


use App\Models\User;
use Illuminate\Validation\Rule;
use Throwable;

class UpdateUser
{


    public function __invoke(User $user)
    {
        abort_if(!auth()->user()->hasRole('super-admin'),401);

        $validated = request()?->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique(User::class, 'email')->ignore($user->id, 'id')],
            'role' => ['required', 'exists:roles,id'],
            'organization_id' => 'required|exists:organizations,id'
        ]);

        try {
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->organization_id = $validated['organization_id'];
            $user->syncRoles($validated['role'])
                ->save();

            flash()->addSuccess('Usuário actualizado com sucesso.');
        } catch (Throwable $th) {

            throw $th;
            flash()->addError('Erro na actualização do usuário.');
        }

        return \redirect()->back();
    }
}
