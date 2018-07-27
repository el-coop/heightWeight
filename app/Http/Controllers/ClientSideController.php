<?php

namespace App\Http\Controllers;

use App;
use App\Models\Product;
use Illuminate\Http\Request;
use ShopifyApp;

class ClientSideController extends Controller {
	public function product(Product $product) {
		$lang = $product->shop->getLocale();
		App::setLocale($lang);
		return view('client.calculator', compact('product'));
	}
	
	
	public function checkProduct(Request $request, $productId) {
		if ($product = Product::where('shopify_id', $productId)->first()) {
			if ($product->visible) {
				$lang = $product->shop->getLocale();
				App::setLocale($lang);
				
				return response()->json([
					"visible" => true,
					"buttonText" => __('calculator.calculate')
				])->header('Access-Control-Allow-Origin', $request->header('origin'))
					->header('Access-Control-Allow-Methods', 'GET')
					->header('Access-Control-Allow-Credentials', 'true');
			}
		}
		
		return response()->json([
			"visible" => false,
		])->header('Access-Control-Allow-Origin', $request->header('origin'))
			->header('Access-Control-Allow-Methods', 'GET')
			->header('Access-Control-Allow-Credentials', 'true');
	}
}
