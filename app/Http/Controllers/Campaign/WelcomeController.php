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
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'campaigns' => $this->handle(request('cause') ?? null),
            'causes' => CauseData::collection(Cause::all()),
            'urgent_priority' => CampaignData::collection(Campaign::urgentPriority()->take(3)->get()),
            'high_priority' => CampaignData::collection(Campaign::highPriority()->take(3)->get()),
            'low_priority' => CampaignData::collection(Campaign::lowPriority()->take(3)->get()),
            'medium_priority' => CampaignData::collection(Campaign::mediumPriority()->take(3)->get()),
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
