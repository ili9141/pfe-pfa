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
            $table->string('lastname');
            $table->string('firstname');
            $table->string('phone_number')->nullable();
            $table->date('date_of_birth');
            $table->string('cin');
            $table->string('email')->unique();
            $table->string('profile_picture_url')->nullable();
            $table->string('password_hash');
            $table->timestamps();  // Creates 'created_at' and 'updated_at'
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
