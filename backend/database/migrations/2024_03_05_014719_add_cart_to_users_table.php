<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCartToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('cart')->nullable()->default(null)->after('role');
        });

        // Set default value to 0 for users with role 'buyer'
        \DB::table('users')->where('role', 'buyer')->update(['cart' => 0]);
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cart');
        });
    }
}
