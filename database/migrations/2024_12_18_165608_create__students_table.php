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
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->date('date_of_birth');
            $table->string('phone_number')->nullable();
            $table->string('profile_picture_url')->nullable();
            $table->string('cin');
            $table->string('student_id');
            $table->string('department');
            $table->string('year');
            $table->string('major');
            $table->foreignId('assigned_professor_id')->nullable()->constrained('professors'); // Assuming the relationship with professors
            $table->enum('internship_status', ['active', 'completed', 'pending']);
            $table->string('company_name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('resume_url')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->timestamps();  // Creates 'created_at' and 'updated_at'
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
