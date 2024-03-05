<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePostsTableAndAddColumns extends Migration
{
    public function up()
    {
        Schema::rename('posts', 'products');

        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('quantity')->default(1);
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('quantity');
        });

        Schema::rename('products', 'posts');
    }
}
