<?php

namespace App\Http\Controllers\Province;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Inertia\Inertia;

class EditProvinceController extends Controller
{
    public function __invoke(Province $province)
    {
        return Inertia::render('Province/Edit', [
            'province' => $province
        ]);
    }
}
