<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPurchasedProductsTable extends Migration
{
    public function up()
    {
        Schema::table('purchased_products', function (Blueprint $table) {
            $table->foreignId('references')->constrained('products');
            $table->unsignedInteger('rating')->nullable();
        });
    }

    public function down()                  
    {
        Schema::table('purchased_products', function (Blueprint $table) {
            $table->dropForeign(['references']);
            $table->dropColumn(['references', 'rating']);
        });
    }
}
