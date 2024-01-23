<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Data\CauseData;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Cause extends Model
{
    use HasUlids;
    use WithData;
	protected $table = 'causes';
	public $incrementing = false;
    protected  string $dataClass = CauseData::class;

	protected $fillable = [
		'title',
		'description'
	];

	public function campaigns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(Campaign::class);
	}
}
