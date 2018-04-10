<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;
use ShopifyApp;

class UpdateSizeNameRequest extends FormRequest {
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
			'size_name' => 'required',
		];
	}

	public function commit() {
		$shop = ShopifyApp::shop();
		$shop->size_name = $this->input('size_name');
		$shop->save();
	}
}
