<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name');
            $table->integer('price')->unsigned();
            $table->string('description', 1000);
            $table->integer('quantity_available')->unsigned();
            $table->string('status')->default(\App\Models\Product::UNAVAILABLE_PRODUCT);
            $table->string('image', 1000);
            $table->bigInteger('seller_id')->unsigned();
            $table->timestamps();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
