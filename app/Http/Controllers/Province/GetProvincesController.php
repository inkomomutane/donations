<?php

namespace App\Http\Controllers\Province;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Inertia\Inertia;

class GetProvincesController extends Controller
{
    public function __invoke()
    {
        $provinces = Province::all();
        return Inertia::render('Province/Index', [
            'provinces' => $provinces
        ]);
    }
}
