<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\CopyProductData;
use App\Http\Requests\Store\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use ShopifyApp;

class ProductController extends Controller {

	public function productForm($productId) {
		try {
			$shop = ShopifyApp::shop();
			$product = $shop->api()->request('GET', "/admin/products/{$productId}.json")->body->product;
		} catch (\Exception $exception) {
			return redirect()->action('StoreController@home');
		}
		$productModel = Product::firstOrCreate(['shopify_id' => $productId, 'shop_id' => $shop->id]);

		return view('store.product', compact('shop', 'product', 'productModel'));
	}

	public function updateProduct(UpdateProductRequest $request, $productid) {
		$request->commit();

		return back()->with('notice', 'Success');
	}

	public function toggleProductVisibility($productId) {
		$shop = ShopifyApp::shop();
		$productModel = Product::firstOrCreate(['shopify_id' => $productId, 'shop_id' => $shop->id]);

		$productModel->visible = !$productModel->visible;
		$productModel->save();

		return response()->json([
			'success' => true,
			'visible' => $productModel->visible,
		]);
	}

	public function copyProduct(CopyProductData $request, Product $product) {
		$request->commit();

		return response()->json([
			'success' => true,
		]);
	}

}
