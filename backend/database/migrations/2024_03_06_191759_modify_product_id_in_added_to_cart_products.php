<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('added_to_cart_products', function (Blueprint $table) {
            // $table->dropForeign(['product_id']);
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        // You can define the rollback operation if needed
    }
};
