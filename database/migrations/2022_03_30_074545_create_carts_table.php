<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string("user_id", 100)->nullable();
            $table->decimal("product_id", 6, 0);
            $table->string("name", 255);
            $table->decimal("price", 6, 2);
            $table->decimal("quantity", 6, 0);
            $table->decimal("subtotal", 6, 2);
            $table->string("product_order", 100)->nullable();
            $table->string("coupon_id", 100)->nullable();
            $table->longText("shipping_address")->nullable();
            $table->string("pay_method", 100)->nullable();
            $table->string("invoice_no", 100)->nullable();
            $table->string("delivery_time", 100)->nullable();
            $table->string("purchase_date", 100)->nullable();
            $table->string("created_at", 100)->nullable();
            $table->timestamp("updated_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
