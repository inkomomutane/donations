<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;


class CampaignTransaction extends Model
{
    use HasUlids;
	protected $table = 'campaign_transactions';
	public $incrementing = false;

	protected $casts = [
		'amount' => 'float'
	];

	protected $fillable = [
		'amount',
		'campaign_id',
		'transaction_id',
		'name',
		'payment_method'
	];

	public function campaign(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Campaign::class);
	}
}
