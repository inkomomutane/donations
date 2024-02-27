<?php

namespace App\Http\Controllers\Campaign;

use App\Data\CampaignData;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Inertia\Inertia;

class ViewCampaignOnWebsiteController extends Controller
{
    public function __invoke(Campaign $campaign)
    {
        return Inertia::render('Website/ViewCampaignOnWebsite', [
            'campaign' => CampaignData::fromModel($campaign->load([
                'postedBy','campaignComments','cause','district'
            ])),
        ]);
    }
}
