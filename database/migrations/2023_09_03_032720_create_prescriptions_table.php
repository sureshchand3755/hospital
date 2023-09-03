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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id')->nullable();
            $table->integer('prescription_doctor_id')->nullable();
            $table->string('upload_path')->nullable();
            $table->string('upload_image')->nullable();
            $table->text('prescriptions')->nullable();
            $table->char('deleted_at', 1)->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
