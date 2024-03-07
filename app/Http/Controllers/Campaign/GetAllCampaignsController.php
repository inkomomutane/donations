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
            'campaigns' => $this->handle(request('cause'),request('search')),
            'causes' => CauseData::collection(Cause::all()),
        ]);
    }

    public function handle($cause = null,?string $search = null){
        if($cause) {
            $campaigns = Campaign::query()->whereCauseId($cause)
                ->when($search, function ($query, $search) {
                    return $query->whereAny(['title','description'],'like',"%$search%");
                })
                ->paginate(12);
        } else {
            $campaigns = Campaign::query()
                ->when($cause, function ($query, $cause) {
                    return $query->whereCauseId($cause);
                })
                ->when($search, function ($query, $search) {
                return $query->whereAny(['title','description'],'like',"%$search%");
            })
                ->paginate(12);
        }
        return CampaignData::collection($campaigns);
    }
}
