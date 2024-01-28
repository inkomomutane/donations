<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Data\CampaignData;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Campaign extends Model implements  HasMedia

{
    use HasUlids;
    use WithData;
    use InteractsWithMedia;

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
		'district_id',
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

	public function district(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(District::class);
	}

	public function campaignComments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(CampaignComment::class);
	}

	public function campaignTransactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(CampaignTransaction::class);
	}

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('campaigns')
            ->withResponsiveImages()
            ->singleFile();
    }
}
