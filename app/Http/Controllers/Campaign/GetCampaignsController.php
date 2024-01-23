<?php

namespace App\Http\Controllers\Campaign;

use App\Data\CampaignData;
use App\Enums\CampaignEnum;
use App\Enums\CampaignPaymentMethodEnum;
use App\Enums\CampaignPriorityEnum;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Inertia\Inertia;

class GetCampaignsController extends Controller
{
    public function __invoke()
    {
        $campaigns = Campaign::paginate(12);
        return Inertia::render('Campaign/Index', [
            'campaigns' => CampaignData::collection($campaigns),
            'statuses' => CampaignEnum::toValues(),
            'paymentMethods' => CampaignPaymentMethodEnum::toValues(),
            'priorities' => CampaignPriorityEnum::toValues(),
        ]);
    }
}
