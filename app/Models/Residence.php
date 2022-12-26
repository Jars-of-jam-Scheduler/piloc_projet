<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Residence extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'label',
		'street',
		'city', 
		'zipcode', 
		'lng', 
		'lat', 
		'surface',
		'monthly_price', 
		'status',
	];

	public function landlords()
	{
		return $this->belongsToMany(User::class, 'landlord_residence', 'residence_id', 'landlord_id');
	}
}
