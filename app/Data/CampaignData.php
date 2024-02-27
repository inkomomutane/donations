<?php

namespace App\Data;

use App\Enums\CampaignEnum;
use App\Enums\CampaignPriorityEnum;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;

/** @typescript */
class CampaignData extends Data
{
    public function __construct(
        public readonly  ?string $id,
        public readonly  ?string $title,
        public readonly  ?string $description,
        public readonly  ?float $goalAmount,
        public readonly  ?float $currentAmount,
        public readonly  ?string $startDate,
        public readonly  ?string $endDate,
        public readonly  CampaignEnum $status,
        public readonly  CampaignPriorityEnum $priority,
        public readonly  Lazy|null|DistrictData $district,
        public readonly  Lazy|null|CauseData $cause,
        public readonly  ?string $postedAt,
        public readonly  Lazy|null|UserData $postedBy,
        public readonly  Lazy|null|MediaData $media,
        #[DataCollectionOf(CampaignComment::class)]
        public readonly  DataCollection $comments,
    ) {}

    public static function fromModel(Campaign $campaign) :self{

        $campaign->loadMissing(['district','cause','postedBy','media' =>  function(MorphMany $morphMany){
            $morphMany->where('collection_name','=','campaigns')->get();
        }]);

        return new self(
            id: $campaign->id,
            title: $campaign->title,
            description: $campaign->description,
            goalAmount: $campaign->goal_amount,
            currentAmount: $campaign->current_amount,
            startDate: $campaign->start_date ? $campaign->start_date->format('Y-m-d') : null,
            endDate: $campaign->end_date ? $campaign->end_date->format('Y-m-d') : null,
            status: $campaign->status,
            priority: $campaign->priority,
            district: Lazy::whenLoaded('district',$campaign, static fn() => $campaign->district->getData()),
            cause: Lazy::whenLoaded('cause',$campaign,static fn() => $campaign->cause->getData()),
            postedAt: $campaign->posted_at ? $campaign->posted_at->format('Y-m-d') : null,
            postedBy:Lazy::whenLoaded('postedBy',$campaign,static fn() => $campaign->postedBy->getData()
            ),
            media:MediaData::fromModel($campaign->getFirstMedia('campaigns')),
            comments: CampaignComment::collection($campaign->campaignComments)
        );
    }

}
