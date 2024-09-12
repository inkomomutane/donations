<?php

namespace App\Http\Controllers\Campaign;

use App\Data\CampaignData;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\View\View;
use Inertia\Inertia;

class ViewCampaignOnWebsiteController extends Controller
{
    public function __invoke(Campaign $campaign)
    {
        \Session::remove('seo');
        \Session::put('seo',$campaign);
        return Inertia::render('Website/ViewCampaignOnWebsite', [
            'campaign' => CampaignData::fromModel($campaign->load([
                'postedBy','campaignComments','cause','district'
            ])),
        ]);
    }
}
