<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Data\TransactionData;
use App\Enums\CampaignPaymentMethodEnum;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;


class CampaignTransaction extends Model
{
    use HasUlids;
    use WithData;
	protected $table = 'campaign_transactions';
	public $incrementing = false;

    protected string $dataClass = TransactionData::class;

	protected $casts = [
		'amount' => 'float',
        'payment_method' => CampaignPaymentMethodEnum::class,
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
