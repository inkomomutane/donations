<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;

class DeleteOrganizationController extends Controller
{
    public function __invoke(Organization $organization)
    {
        abort_if(!auth()->user()->hasRole('super-admin'),401);
        \DB::beginTransaction();
            $organization->delete();
        \DB::commit();
        flash()->addSuccess('Organization removed successful');
        return redirect()->back();
    }
}
