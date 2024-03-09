<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Remove the existing foreign key constraint
        // Schema::table('purchased_products', function (Blueprint $table) {
        //     $table->dropForeign(['references']);
        // });

        // Add a new foreign key constraint with onDelete set to set null
        Schema::table('purchased_products', function (Blueprint $table) {
            $table->foreignId('references')->nullable()->constrained('products')->onDelete('set null');
        });
    }

    public function down()
    {
        // Remove the existing foreign key constraint
        Schema::table('purchased_products', function (Blueprint $table) {
            $table->dropForeign(['references']);
        });

        // Recreate the foreign key constraint without onDelete
        Schema::table('purchased_products', function (Blueprint $table) {
            $table->foreignId('references')->constrained('products');
        });
    }
        
};
