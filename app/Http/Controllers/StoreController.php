<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use OhMyBrew\ShopifyApp\Facades\ShopifyApp;

class StoreController extends Controller {

	public function home() {
		$shop = ShopifyApp::shop();

		return view('store.home', compact('shop', 'products'));
	}

	public function products(Request $request) {
		$shop = ShopifyApp::shop();
		$perPage = 25;

		$totalProducts = $shop->product_count;
		$pageCount = $request->filled('filter') ? 1 : ceil($totalProducts / $perPage);
		$currentPage = (int)$request->input('page');
		$response = $shop->api()->request('GET', "/admin/products.json", [
			'collection_id' => $shop->collection_id,
			'limit' => $perPage,
			'page' => $currentPage,
			'title' => $request->input('filter', null),
		]);


		return response()->json([
			'current_page' => $currentPage,
			'data' => $response->body->products,
			'per_page' => $perPage,
			'first_page_url' => action('StoreController@products', [
				'page' => 1,
			]),
			'last_page' => $pageCount,
			'last_page_url' => action('StoreController@products', [
				'page' => $pageCount,
			]),
			'next_page_url' => $currentPage == $pageCount ? null : action('StoreController@products', [
				'page' => $currentPage + 1,
			]),
			'prev_page_url' => $currentPage == 1 ? null : action('StoreController@products', [
				'page' => $currentPage - 1,
			]),
			'path' => action('StoreController@products'),
			'from' => $currentPage * $perPage,
			'to' => $currentPage * $perPage + count($response->body) - 1,
			'total' => $totalProducts,
		]);
	}

	public function productForm($productId) {
		try {
			$shop = ShopifyApp::shop();
			$product = $shop->api()->request('GET', "/admin/products/{$productId}.json")->body->product;
		} catch (\Exception $exception) {
			return redirect()->action('StoreController@home');
		}
		$productModel = Product::firstOrCreate(['shopify_id' => $productId,'shop_id' => $shop->id]);

		return view('store.product', compact('shop', 'product', 'productModel'));
	}

	public function updateProduct(UpdateProductRequest $request, $productid) {
		$request->commit();

		return back()->with('notice','Success');
	}
}