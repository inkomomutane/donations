<?php

namespace App\Http\Controllers\Province;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CreateProvinceController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Province/Create');
    }
}
