<?php

namespace App\Http\Requests\Store;

use App\Mail\StoreContactMail;
use Illuminate\Foundation\Http\FormRequest;
use Mail;
use ShopifyApp;

class ContactRequest extends FormRequest {
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
			'message' => 'required'
		];
	}
	
	public function commit() {
		$shop = ShopifyApp::shop();
		Mail::to('hw@seezerapps.com ')->send(new StoreContactMail($shop->shopify_domain, $this->input('message')));
	}
}
