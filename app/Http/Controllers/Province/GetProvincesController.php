<?php

namespace App\Http\Controllers\Province;

use App\Data\ProvinceData;
use App\Http\Controllers\Controller;
use App\Models\Province;
use Inertia\Inertia;

class GetProvincesController extends Controller
{
    public function __invoke()
    {
        $provinces = Province::paginate(15);
        return Inertia::render('Province/Index', [
            'provinces' => ProvinceData::collection($provinces)
        ]);
    }
}
