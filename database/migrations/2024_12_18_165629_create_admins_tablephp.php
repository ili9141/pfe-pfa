<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key for the relationship with the users table
            $table->string('lastname');
            $table->string('firstname');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->date('date_of_birth');
            $table->string('cin');
            $table->string('password');
            $table->string('profile_picture_url')->nullable();
            $table->timestamps();

            // Foreign key constraint linking to the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
