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
        Schema::create('patient_details', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
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
            $table->text('address')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('education')->nullable();
            $table->string('ref_by')->nullable();
            $table->string('occupation')->nullable();
            $table->string('send_alert', 1)->nullable();
            $table->string('blood')->nullable();
            $table->string('diet')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('brith_weight')->nullable();
            $table->text('any_mediciens')->nullable();
            $table->text('note')->nullable();
            $table->integer('doctor_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->char('status', 1)->default('P');
            $table->char('deleted_at', 1)->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_details');
    }
};
