<?php

namespace App\Events\Shop;

use App\Models\Shop;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ShopCreated {
	use Dispatchable, InteractsWithSockets, SerializesModels;
	/**
	 * @var Shop
	 */
	public $shop;

	/**
	 * Create a new event instance.
	 *
	 * @param Shop $shop
	 */
	public function __construct(Shop $shop) {
		//
		$this->shop = $shop;
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return \Illuminate\Broadcasting\Channel|array
	 */
	public function broadcastOn() {
		return new PrivateChannel('channel-name');
	}
}
