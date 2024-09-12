<?php

namespace App\Http\Controllers\Campaign;

use App\Data\CampaignData;
use App\Data\CauseData;
use App\Data\DistrictData;
use App\Enums\CampaignEnum;
use App\Enums\CampaignPaymentMethodEnum;
use App\Enums\CampaignPriorityEnum;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Cause;
use App\Models\District;
use App\Models\User;
use Inertia\Inertia;

class GetCampaignsController extends Controller
{
    public function __invoke()
    {
        $campaigns = Campaign::paginate(12);
        return Inertia::render('Dashboard', [
            'campaigns' => $this->handle(request('search'),auth()->user()),
            'statuses' => CampaignEnum::toValues(),
            'paymentMethods' => CampaignPaymentMethodEnum::toValues(),
            'priorities' => CampaignPriorityEnum::toValues(),
            'causes' => CauseData::collection(Cause::all()),
            'districts' => DistrictData::collection(District::all())
        ]);
    }

    public function handle(string $search = null,User $user){
        $campaigns = Campaign::query()
            ->wherePostedById($user->id)
            ->when($search, function ($query, $search) {
                return $query->whereAny(['title','description'],'like',"%$search%");
            })
            ->paginate(12);
        return CampaignData::collection($campaigns);
    }
}
