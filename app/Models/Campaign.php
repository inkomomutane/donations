<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Data\CampaignData;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;


class Campaign extends Model
{
    use HasUlids;
    use WithData;

	protected $table = 'campaigns';
	public $incrementing = false;
    protected  string $dataClass = CampaignData::class;

	protected $casts = [
		'content' => 'json',
		'goal_amount' => 'int',
		'current_amount' => 'int',
		'start_date' => 'datetime',
		'end_date' => 'datetime',
		'posted_at' => 'datetime'
	];

	protected $fillable = [
		'title',
		'description',
		'content',
		'goal_amount',
		'current_amount',
		'start_date',
		'end_date',
		'status',
		'priority',
		'province_id',
		'cause_id',
		'posted_at',
		'posted_by_id'
	];

	public function cause(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Cause::class);
	}

	public function postedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(User::class, 'posted_by_id');
	}

	public function province(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Province::class);
	}

	public function campaignComments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(CampaignComment::class);
	}

	public function campaignTransactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(CampaignTransaction::class);
	}
}
