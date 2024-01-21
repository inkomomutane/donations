<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;


class Province extends Model
{
    use HasUlids;
	protected $table = 'provinces';
	public $incrementing = false;

	protected $fillable = [
		'name'
	];

	public function campaigns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(Campaign::class);
	}
}
