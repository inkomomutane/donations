<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasUlids;
	protected $table = 'causes';
	public $incrementing = false;

	protected $fillable = [
		'title',
		'description'
	];

	public function campaigns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(Campaign::class);
	}
}
