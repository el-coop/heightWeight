<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;
use ShopifyApp;

class UpdateLanguageRequest extends FormRequest {
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
			'language' => 'required|in:en,fr,de,es'
		];
	}
	
	public function commit() {
		$shop = ShopifyApp::shop();
		$shop->language = $this->input('language');
		$shop->save();
		
	}
}
