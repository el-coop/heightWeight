<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('products', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('shop_id')->unsigned();
			$table->string('shopify_id')->index();
			$table->boolean('visible')->default(false);
			$table->enum('measurement', ['metric', 'imperial'])->nullable();
			$table->enum('type', ['t-shirt', 'pants', 'other'])->nullable();
			$table->enum('gender', ['male', 'female', 'unisex'])->nullable();
			$table->json('data')->nullable();
			$table->timestamps();
			$table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('products');
	}
}
