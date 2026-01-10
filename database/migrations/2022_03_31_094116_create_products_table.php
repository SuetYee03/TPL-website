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
    $table->id();
    $table->string("name", 255)->nullable();
    $table->text("description")->nullable();
    $table->string("image", 255)->nullable();
    $table->decimal("price", 6, 2);

    
    $table->string("category", 50)->nullable();      // regular / special
    $table->unsignedTinyInteger("session")->nullable(); // 0 breakfast, 1 lunch, 2 dinner
    $table->string("available", 100)->nullable();    // Stock / Out Of Stock

    $table->timestamps();
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
}
