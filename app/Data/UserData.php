<?php

namespace App\Data;

use App\Models\User;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

/** @typescript */
class UserData extends Data
{
    public function __construct(
        public readonly  ?string $id,
        public readonly  ?string $name,
        public readonly  ?string $email,
        public readonly  Lazy|null|RoleData $role,
        public readonly  Lazy|OrganizationData|null $organization,
        public bool $isSuperAdmin = false,
    ) {}


    public static function fromModel(User $user): UserData
    {
        return new UserData(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            role: Lazy::whenLoaded('roles',$user,fn() =>  $user->roles->first()?->getData()),
            organization: Lazy::whenLoaded('organization',$user,fn() => $user->organization->getData()),
            isSuperAdmin:  $user->hasRole('super-admin')
        );
    }
}
