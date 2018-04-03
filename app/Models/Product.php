<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['shop_id','shopify_id'];

	protected $casts = [
		'data' => 'array',
	];
}
