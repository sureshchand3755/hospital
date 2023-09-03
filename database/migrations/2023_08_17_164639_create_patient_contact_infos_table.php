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
        Schema::create('patient_contact_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('address')->nullable();
            $table->integer('city')->nullable();
            $table->integer('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('education')->nullable();
            $table->string('ref_by')->nullable();
            $table->string('occupation')->nullable();
            $table->string('send_alert', 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_contact_infos');
    }
};
