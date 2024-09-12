<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Data\CampaignData;
use App\Enums\CampaignEnum;
use App\Enums\CampaignPriorityEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Schema\BreadcrumbListSchema;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\ImageMeta;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\LaravelData\WithData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Campaign extends Model implements  HasMedia

{
    use HasUlids;
    use HasFactory;
    use WithData;
    use InteractsWithMedia;
    use HasSEO;

	protected $table = 'campaigns';
	public $incrementing = false;
    protected  string $dataClass = CampaignData::class;

   protected $with = ['postedBy', 'district', 'cause'];

	protected $casts = [
		'goal_amount' => 'float',
		'current_amount' => 'float',
		'start_date' => 'datetime',
		'end_date' => 'datetime',
		'posted_at' => 'datetime',
        'status' => CampaignEnum::class,
        'priority' => CampaignPriorityEnum::class,

	];

	protected $fillable = [
		'title',
		'description',
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


    protected static function boot(): void
    {
        parent::boot();
    }


    public function scopeActive(Builder $query): void
    {
        $query->where('status', CampaignEnum::ACTIVA()->value);
    }
    public function scopeHighPriority(Builder $query): void
    {
        $query->where('priority', CampaignPriorityEnum::ALTA());
    }

    public function scopeLowPriority(Builder $query): void
    {
        $query->where('priority', CampaignPriorityEnum::BAIXA());
    }



    public function scopeMediumPriority(Builder $query): void
    {
        $query->where('priority', CampaignPriorityEnum::MEDIA());
    }

    public function scopeUrgentPriority(Builder $query): void
    {
        $query->where('priority', CampaignPriorityEnum::URGENTE());
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


    public function getDynamicSEOData(): SEOData
    {

        return new SEOData(
            title: Str::Ucfirst($this->title),
            description: Str::Ucfirst(strip_tags($this->description)),
            author: Str::Ucfirst($this->postedBy->name),
            image: $this->hasMedia('campaigns') ? $this->getFirstMedia('campaigns')?->getUrl() : null,
            imageMeta: $this->hasMedia('campaigns') ? new ImageMeta($this->getFirstMedia('campaigns')?->getUrl()) : null,
            published_time: $this->created_at,
            modified_time: $this->updated_at,
            section: 'Campaigns',
            schema: SchemaCollection::initialize()->addArticle()->addBreadcrumbs(
                fn (BreadcrumbListSchema $breadcrumbs): BreadcrumbListSchema => $breadcrumbs->prependBreadcrumbs([
                    'Homepage' => route('welcome'),
                ])
            ),
            type: 'article',
            canonical_url: route('campaign.view', ['campaign' => $this->id]),
        );
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media|null $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width('200')
            ->nonQueued();

        $this->addMediaConversion('social-media')
            ->width('720')
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('campaigns');
    }


    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CampaignTransaction::class);
    }
}
