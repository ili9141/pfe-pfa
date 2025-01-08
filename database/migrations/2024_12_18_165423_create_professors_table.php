<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessorsTable extends Migration
{
    public function up()
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('phone_number')->nullable();
            $table->date('date_of_birth');
            $table->string('cin');
            $table->string('email')->unique();
            $table->string('profile_picture_url')->nullable();
            $table->string('password_hash')->nullable();
            $table->string('speciality')->nullable();
            $table->foreignId('major_id')->constrained('majors');  // Assuming you have a majors table
            $table->timestamps();  // Creates the 'created_at' and 'updated_at' fields
        });
    }

    public function down()
    {
        Schema::dropIfExists('professors');
    }
}
