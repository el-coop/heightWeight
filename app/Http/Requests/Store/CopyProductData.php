<?php

namespace App\Http\Requests\Store;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use ShopifyApp;

class CopyProductData extends FormRequest {
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
		return [
			'products' => 'required|array',
		];
	}

	public function commit() {
		$shop = ShopifyApp::shop();
		$product = $this->route('product');
		foreach ($this->products as $targetProduct) {
			$targetProduct = Product::firstOrNew(['shopify_id' => $targetProduct, 'shop_id' => $shop->id]);
			$targetProduct->data = $product->data;
			$targetProduct->measurement = $product->measurement;
			$targetProduct->type = $product->type;
			$targetProduct->gender = $product->gender;
			$targetProduct->save();
		}
	}
}
