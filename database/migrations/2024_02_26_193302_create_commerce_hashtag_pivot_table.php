<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommerceHashtagPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerce_hashtag', function (Blueprint $table) {
            $table->foreignId('commerce_id')->onDelete('cascade')->index();
            $table->foreignId('hashtag_id')->onDelete('cascade')->index();
            $table->primary(['commerce_id', 'hashtag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commerce_hashtag');
    }
}
