<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('app_imageable_type');
            $table->unsignedBigInteger('app_imageable_id');
            $table->string('image');
            $table->string('option')->nullable();
            $table->timestamps();
            $table->index(['app_imageable_type', 'app_imageable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_images');
    }
}
