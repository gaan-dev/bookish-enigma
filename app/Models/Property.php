<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model {
	protected $guarded = [];

	public function property_type()
	{
		return $this->belongsTo(PropertyType::class);
	}
}
