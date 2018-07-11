<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreContactMail extends Mailable {
	use Queueable, SerializesModels;
	public $shop;
	public $text;
	
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($shop, $message) {
		//
		$this->shop = $shop;
		$this->text = $message;
	}
	
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->from('hw@seezerapps.com ')->subject('Message from ' . $this->shop)->text('mail.store.message');
	}
}
