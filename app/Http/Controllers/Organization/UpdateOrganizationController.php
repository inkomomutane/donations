<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class UpdateOrganizationController extends Controller
{
    public function __invoke(Organization $organization, Request $request)
    {
        abort_if(!auth()->user()->hasRole('super-admin'),401);

        $validated = $request->validate([
            'name' => ['required','string'],
        ]);

        $organization->update($validated);

        flash()->addSuccess('Organization updated successful.');
        return redirect()->back();
    }
}
