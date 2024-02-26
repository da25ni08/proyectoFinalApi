<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHashtagPublicationPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtag_publication', function (Blueprint $table) {
            $table->foreignId('hashtag_id')->onDelete('cascade')->index();
            $table->foreignId('publication_id')->onDelete('cascade')->index();
            $table->primary(['hashtag_id', 'publication_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hashtag_publication');
    }
}
