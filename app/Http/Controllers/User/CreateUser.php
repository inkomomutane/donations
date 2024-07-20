<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use App\Models\Role;

class CreateUser
{


    public function handle(array $userData): User
    {
        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make('12345678'),
            'organization_id' => $userData['organization_id'],
        ]);
        /** @var User $user */
        $user = User::whereId($user->id)->first();
        $user->assignRole(Role::findById($userData['role']));
        return $user;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'role' => ['required', 'exists:roles,id'],
            'organization_id' => 'required|exists:organizations,id'
        ];
    }

    public function __invoke(Request $request)
    {
        abort_if(!auth()->user()->hasRole('super-admin'),401);
        try {
            $this->handle($request->validate($this->rules()));
            flash()->addSuccess('Usuário criado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
            flash()->addError('Erro ao criar usuário.');
        }

        return \redirect()->back();
    }
}
