<?php

namespace App\Http\Requests\Store;

use App\Models\Button;
use Illuminate\Foundation\Http\FormRequest;
use ShopifyApp;

class UpdateButtonRequest extends FormRequest {
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
			'text' => 'required',
			'color' => 'required',
			'background' => 'required',
			'border' => 'required',
		];
	}
	
	public function commit() {
		
		$shop = ShopifyApp::shop();
		$button = $shop->button;
		if (!$button) {
			$button = new Button;
		}
		$button->text = $this->input('text');
		$button->color = $this->input('color');
		$button->background = $this->input('background');
		$button->border = $this->input('border');
		
		
		$shop->button()->save($button);
	}
}
