<?php

namespace App\Http\Controllers\Cause;

use App\Data\CauseData;
use App\Http\Controllers\Controller;
use App\Models\Cause;
use Inertia\Inertia;

class GetCausesController extends Controller
{
    public function __invoke()
    {
        $causes = Cause::paginate(15);
        return Inertia::render('Cause/Index', [
            'causes' => CauseData::collection($causes)
        ]);
    }
}
