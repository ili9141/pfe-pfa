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
    // Migration file: database/migrations/create_majors_table.php
    public function up()
    {
        Schema::create('majors', function (Blueprint $table) {
            $table->id();
            $table->string('majorName');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('majors');
    }
};
