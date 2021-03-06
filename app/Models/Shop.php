<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use OhMyBrew\ShopifyApp\Models\Shop as BaseShop;

class Shop extends BaseShop {
	
	protected $dates = [
		'trial_end',
	];
	
	public function getTotalProductCountAttribute() {
		return $this->api()->request('GET', '/admin/products/count.json')->body->count;
	}
	
	public function createCollection() {
		$response = $this->api()->request('POST', '/admin/custom_collections.json', [
			"custom_collection" => [
				"title" => "Height & Weight",
				"published" => false
			],
		]);
		$this->collection_id = $response->body->custom_collection->id;
		$this->save();
	}
	
	public function getProducts($perPage = 25, $currentPage = 1, $title = null) {
		if (!$this->collection_id) {
			return false;
		}
		
		try {
			return $this->api()->request('GET', "/admin/products.json", [
				'collection_id' => $this->collection_id,
				'limit' => $perPage,
				'page' => $currentPage,
				'title' => $title,
			])->body->products;
		} catch (Exception $exception) {
		}
		
		return false;
	}
	
	public function button() {
		return $this->hasOne(Button::class);
	}
	
	public function getButtonAttribute() {
		$button = $this->button()->first();
		if (!$button) {
			$button = new Button;
			$button->text = __('calculator.calculate', [], $this->language);
			$button->color = '#f5f5f5';
			$button->background = '#363636';
			$button->border = 'black';
		}
		return $button;
	}
	
	public function getProductCountAttribute() {
		$result = 0;
		try {
			$result = $this->api()->request('GET', '/admin/products/count.json', [
				'collection_id' => $this->collection_id,
			])->body->count;
		} catch (Exception $exception) {
			$this->createCollection();
		}
		
		return $result;
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
	
	public function getLocale() {
		return $this->api()->request('GET', '/admin/shop.json')->body->shop->primary_locale;
	}
}
