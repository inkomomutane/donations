<?php

namespace App\Http\Controllers\Campaign;

use App\Data\CampaignData;
use App\Data\CauseData;
use App\Data\DistrictData;
use App\Enums\CampaignEnum;
use App\Enums\CampaignPaymentMethodEnum;
use App\Enums\CampaignPriorityEnum;
use App\Models\Campaign;
use App\Models\Cause;
use App\Models\District;
use Inertia\Inertia;

class EditCampaignController
{
    public function __invoke(Campaign $campaign)
    {
        return Inertia::render('Campaign/EditCampaign', [
            'campaign' => CampaignData::fromModel($campaign),
            'statuses' => CampaignEnum::toValues(),
            'paymentMethods' => CampaignPaymentMethodEnum::toValues(),
            'priorities' => CampaignPriorityEnum::toValues(),
            'causes' => CauseData::collection(Cause::all()),
            'districts' => DistrictData::collection(District::all())
        ]);
    }
}
