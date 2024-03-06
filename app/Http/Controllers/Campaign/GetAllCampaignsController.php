<?php

namespace App\Http\Controllers\Campaign;

use App\Data\CampaignData;
use App\Data\CauseData;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Cause;
use Inertia\Inertia;

class GetAllCampaignsController extends Controller
{
    public function __invoke()
    {

        return Inertia::render('Website/Campaigns/AllCampaigns',[
            'campaigns' => $this->handle(request('cause')),
            'causes' => CauseData::collection(Cause::all())
        ]);
    }

    public function handle($cause = null) {
        if($cause) {
            $campaigns = Campaign::whereCauseId($cause)->paginate(12);
        } else {
            $campaigns = Campaign::paginate(12);
        }
        return CampaignData::collection($campaigns);
    }
}
