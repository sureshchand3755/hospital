<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_general_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->string('profile_image')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('patient_name')->nullable();
            $table->date('date_of_birth');
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('aadhar_number')->nullable();
            $table->string('father_or_husband', 1)->nullable();
            $table->string('father_or_husband_name')->nullable();
            $table->string('mother_or_wife', 1)->nullable();
            $table->string('mother_or_wife_name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_general_infos');
    }
};
