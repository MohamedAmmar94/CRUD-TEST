<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('title');
            $table->string('description');
            $table->string('price');
            $table->string('images');
            $table->unsignedBigInteger('category')->nullable();
            $table->timestamps();
        });
        Schema::table('products', function($table) {
            $table->foreign('category')->references('id')->on('categories');

        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
}
