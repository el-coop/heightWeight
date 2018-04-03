<?php

namespace App\Http\Requests\Store;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use ShopifyApp;

class UpdateProductRequest extends FormRequest {
	protected $variants;
	protected $shop;
	protected $product;

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		$this->shop = ShopifyApp::shop();
		$this->product = $this->shop->api()->request('GET', "/admin/products/{$this->route('productId')}.json")->body->product;
		$this->variants = $this->product->variants;

		$rules = [
			'measurement' => 'required|in:metric,imperial',
			'type' => 'required|in:t-shirt,shirt,pants,dress',
			'gender' => 'required|in:male,female',
		];
		foreach ($this->variants as $variant) {
			foreach (['height', 'weight', 'bust', 'waist', 'length', 'shoulders', 'sleeve'] as $part) {
				$rules["{$variant->title}_{$part}_min"] = 'required|numeric';
				$rules["{$variant->title}_{$part}_max"] = [
					'required',
					'numeric',
					function ($attribute, $value, $fail) use($variant, $part) {
						if ($value < $this->input("{$variant->title}_{$part}_min")) {
							return $fail($attribute . ' has to larger than min attribute.');
						}
					},
				];
			}
		}

		return $rules;
	}

	public function commit() {
		foreach ($this->variants as $variant) {
			foreach (['height', 'weight', 'bust', 'waist', 'length', 'shoulders', 'sleeve'] as $part) {
				$keys[] = "{$variant->title}_{$part}_min";
				$keys[] = "{$variant->title}_{$part}_max";
			}
		}

		$product = Product::where('shop_id', $this->shop->id)->where('shopify_id', $this->route('productId'))->first();
		$product->measurement = $this->input('measurement');
		$product->gender = $this->input('gender');
		$product->type = $this->input('type');
		$product->data = $this->only($keys);
		$product->save();
	}
}
