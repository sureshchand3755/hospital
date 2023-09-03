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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_no');
            $table->date('appointment_date');
            $table->integer('hospital_id');
            $table->foreignId('doctor_id');
            $table->string('treatment_id');
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->char('deleted_at', 1)->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
