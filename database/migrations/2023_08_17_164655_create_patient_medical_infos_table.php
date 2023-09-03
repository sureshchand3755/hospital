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
        Schema::create('patient_medical_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('blood')->nullable();
            $table->string('diet')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('brith_weight')->nullable();
            $table->text('any_mediciens')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_medical_infos');
    }
};
