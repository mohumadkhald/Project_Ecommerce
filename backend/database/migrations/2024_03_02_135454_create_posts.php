<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id(); // Post ID (Primary Key)
        $table->unsignedBigInteger('user_id'); // User ID (Foreign Key)
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->text('description'); // Post Description
        $table->string('image')->nullable(); // Image Property (nullable if posts don't always have images)
        $table->timestamps(); // Created at and Updated at timestamps
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
    });

    Schema::dropIfExists('posts');
}

};
