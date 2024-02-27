<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;


class CampaignComment extends Model
{
    use HasUlids;
    use WithData;

	protected $table = 'campaign_comments';

    protected string $dataClass = \App\Data\CampaignComment::class;
	public $incrementing = false;

	protected $fillable = [
		'name',
		'comment',
		'campaign_id'
	];

    public  static function boot(): void
    {
        parent::boot();

        static::addGlobalScope('orderByCreatedAt', static function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

	public function campaign(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Campaign::class);
	}
}
