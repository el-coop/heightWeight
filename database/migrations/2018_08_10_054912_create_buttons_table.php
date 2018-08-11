<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateButtonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buttons', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('shop_id')->unsigned();
			$table->string('text');
			$table->string('color');
			$table->string('background');
			$table->string('border');
            $table->timestamps();
			$table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buttons');
    }
}
