<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedProductsTable extends Migration
{
    public function up()
    {
        Schema::create('purchased_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('buyer_id')->constrained('users');
            $table->integer('quantity');
            $table->foreignId('purchase_id')->constrained('purchases');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchased_products');
    }
}
