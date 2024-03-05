<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add phone_number column
            $table->string('phone_number')->nullable();

            // Add address column
            $table->string('address')->nullable();

            // Add gender column
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse the changes in the down method if needed
            $table->dropColumn('phone_number');
            $table->dropColumn('address');
            $table->dropColumn('gender');
        });
    }
}

