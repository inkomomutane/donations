<?php

namespace App\Data;

use App\Enums\CampaignEnum;
use App\Enums\CampaignPriorityEnum;
use App\Models\Campaign;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

/** @typescript */
class CampaignData extends Data
{
    public function __construct(
        public readonly  ?string $id,
        public readonly  ?string $title,
        public readonly  ?string $description,
        public readonly  ?string $content,
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
    ) {}

    public static function fromModel(Campaign $campaign) :self{
        return new self(
            id: $campaign->id,
            title: $campaign->title,
            description: $campaign->description,
            content: $campaign->content,
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
            )
        );
    }
}
