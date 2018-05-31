<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ShopifyApp;

class Product extends Model {
	protected $fillable = ['shop_id', 'shopify_id'];
	
	protected $casts = [
		'visible' => 'boolean',
		'data' => 'array',
	];
	
	public function getRouteKeyName() {
		return 'shopify_id';
	}
	
	static public function getVariants($product) {
		$shop = ShopifyApp::shop();
		$option = collect($product->options)->firstWhere('name', $shop->size_name)->position ?? null;
		if (!$option) {
			$variants = collect([]);
		} else {
			$variants = collect($product->variants)->groupBy("option{$option}");
		}
		
		return $variants;
	}
	
	public function shop() {
		return $this->belongsTo(Shop::class);
	}
	
	static public function productAttributes($product) {
		return ['bust', 'waist', 'length', 'shoulders', 'sleeve', 'height', 'weight'];
	}
}
