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
        Schema::create('students', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // Foreign key reference to users table
            $table->string('year')->nullable();  // Store the year (freshman, sophomore, etc.)
            $table->foreignId('major_id')->nullable()->constrained('majors');  // Foreign key to the majors table
            $table->string('profile_picture_url')->nullable();  // Store profile picture URL
            $table->timestamps();  // Default Laravel timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
