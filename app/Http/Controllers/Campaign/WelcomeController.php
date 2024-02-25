<?php

namespace App\Http\Controllers\Campaign;

use App\Data\CampaignData;
use App\Data\CauseData;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Cause;
use Inertia\Inertia;
use Route;
use Illuminate\Foundation\Application;
class WelcomeController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'campaigns' => $this->handle(request('cause')),
            'total_campaigns' =>Campaign::whereStatus('COMPLETA')->count(),
            'total_amount_raised' => Campaign::sum('current_amount'),
            'causes' => CauseData::collection(Cause::all()),
            'high_priority' => CampaignData::collection(Campaign::active()->highPriority()->take(6)->get()),
            'low_priority' => CampaignData::collection(Campaign::active()->lowPriority()->take(6)->get()),
            'medium_priority' => CampaignData::collection(Campaign::active()->mediumPriority()->take(6)->get()),
        ]);
    }

    public function handle($cause = null) {
        if($cause) {
            $campaigns = Campaign::where('cause_id', $cause)->paginate(12);
        } else {
            $campaigns = Campaign::paginate(12);
        }
        return CampaignData::collection($campaigns);
    }

}
