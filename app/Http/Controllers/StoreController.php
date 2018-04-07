<?php

namespace App\Http\Controllers;

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
		$products = $shop->api()->request('GET', "/admin/products.json", [
			'collection_id' => $shop->collection_id,
			'limit' => $perPage,
			'page' => $currentPage,
			'title' => $request->input('filter', null),
		])->body->products;
		foreach ($products as $product) {
			$product->visible = false;
			$percent = 0;
			if ($productModel = Product::where('shop_id', $shop->id)->where('shopify_id', $product->id)->first()) {
				$product->visible = $productModel->visible;
				foreach ($product->variants as $variant) {
					if (isset($productModel->data["{$variant->title}_height_min"])) {
						$percent++;
					}
				}
				$percent = $percent / count($product->variants) * 100;
			}

			$product->percentCompleted = $percent;
		}

		return response()->json([
			'current_page' => $currentPage,
			'data' => $products,
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
			'to' => $currentPage * $perPage + count($products) - 1,
			'total' => $totalProducts,
		]);
	}

}