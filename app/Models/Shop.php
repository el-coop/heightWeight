<?php

namespace App\Models;

use Carbon\Carbon;
use OhMyBrew\ShopifyApp\Models\Shop as BaseShop;

class Shop extends BaseShop {

	protected $dates = [
		'trial_end',
	];

	public function getTotalProductCountAttribute() {
		return $this->api()->request('GET', '/admin/products/count.json')->body->count;
	}

	public function getProductCountAttribute() {
		return $this->api()->request('GET', '/admin/products/count.json', [
			'collection_id' => $this->collection_id,
		])->body->count;
	}

	public function getPlanAttribute() {
		if ($this->trial_end < Carbon::now()) {
			return config('shopify-app.billing_plan');
		}
		$daysLeft = $this->trial_end->diff(Carbon::now())->days;
		$plan = "Trial ({$daysLeft} day";
		if ($daysLeft != 1) {
			$plan .= 's';
		}
		$plan .= " left)";

		return $plan;
	}
}
