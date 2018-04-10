<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataToShopsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('shops', function (Blueprint $table) {
			$table->string('size_name')->default('Size')->after('shopify_token');
			$table->string('collection_id')->nullable()->after('size_name');
			$table->timestamp('trial_end')->nullable()->after('collection_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('shops', function (Blueprint $table) {
			// Laravel doesn't seem to support multiple dropColumn commands
			// See: (https://github.com/laravel/framework/issues/2979#issuecomment-227468621)
			$table->dropColumn('trial_end');
			$table->dropColumn('collection_id');
		});
	}
}
