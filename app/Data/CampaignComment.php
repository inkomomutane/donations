<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use App\Models\CampaignComment as CampaignCommentModel;
/** @typescript  */
class CampaignComment extends Data
{
    public function __construct(
        public string $name,
        public string $comment,
        public string $createdAt,
    ){}

    public static function fromModel(CampaignCommentModel $comment): self
    {
        return new self(
            name: $comment->name,
            comment: $comment->comment,
            createdAt: $comment->created_at->format('j F, Y \a\t H:i')
        );
    }
}
