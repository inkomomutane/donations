<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Data\ProvinceData;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;


class Province extends Model
{
    use HasUlids;
    use withData;
	protected $table = 'provinces';
	public $incrementing = false;
    protected string $dataClass = ProvinceData::class;

	protected $fillable = [
		'name'
	];

	public function campaigns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(Campaign::class);
	}
}
