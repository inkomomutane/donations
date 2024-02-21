<?php

namespace App\Http\Controllers\Campaign;

use App\Data\CampaignData;
use App\Data\CauseData;
use App\Models\Campaign;
use App\Models\Cause;
use Illuminate\Foundation\Application;
use Inertia\Inertia;
use Route;

class ShowCampaignByCauseController
{

    public  function __invoke(Cause $cause = null)
    {
        $campaigns = Campaign::where('cause_id', $cause->id)->paginate(12);
        return Inertia::render('Welcome', [
            'campaigns' => CampaignData::collection($campaigns),
            'causes' => CauseData::collection(Cause::all()),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
