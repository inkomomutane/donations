<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;


class CampaignComment extends Model
{
    use HasUlids;
	protected $table = 'campaign_comments';
	public $incrementing = false;

	protected $fillable = [
		'name',
		'comment',
		'campaign_id'
	];

	public function campaign(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Campaign::class);
	}
}
