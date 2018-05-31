<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ClientSideController extends Controller {
	public function product(Product $product) {
		return view('client.calculator', compact('product'));
	}
	
	
	public function checkProduct($productId) {
		if ($product = Product::where('shopify_id', $productId)->first()) {
			if ($product->visible) {
				$shop = $product->shop;
				return response()->json([
					"visible" => true,
				])->header('Access-Control-Allow-Origin', "https://{$shop->shopify_domain}")
					->header('Access-Control-Allow-Methods', 'GET')
					->header('Access-Control-Allow-Credentials', 'true');
			}
		}
		
		return response()->json([
			"visible" => false,
		])->header('Access-Control-Allow-Origin', '*')
			->header('Access-Control-Allow-Methods', 'GET');;
	}
}
