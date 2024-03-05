<?php

namespace App\Http\Controllers\Campaign;

use App\Data\CampaignData;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Inertia\Inertia;

class GetAllCampaignsController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Website/Campaigns/AllCampaigns',[
            'campaigns' => $this->handle(request('cause')),
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
