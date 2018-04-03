<?php

namespace App\Listeners\Shop;

use App\Events\Shop\ShopCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateCollection {
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  ShopCreated $event
	 *
	 * @return void
	 */
	public function handle(ShopCreated $event) {
		if (!$event->shop->collection_id) {
			$response = $event->shop->api()->request('POST', '/admin/custom_collections.json', [
				"custom_collection" => [
					"title" => "Height & Weight",
				],
			]);
			$event->shop->collection_id = $response->body->custom_collection->id;
			$event->shop->save();
		}
	}
}
