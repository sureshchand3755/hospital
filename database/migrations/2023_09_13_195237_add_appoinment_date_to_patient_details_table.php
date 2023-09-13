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
        Schema::table('patient_details', function (Blueprint $table) {
            $table->after('department_id', function ($table) {
                $table->date('appoinment_date')->nullable();
                $table->integer('visit_id')->nullable();
                $table->integer('illness_id')->nullable();
                $table->integer('appointment_mode_id')->nullable();
                $table->integer('symptoms_id')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_details', function (Blueprint $table) {
            $table->dropColumn('appoinment_date');
            $table->dropColumn('visit_id');
            $table->dropColumn('illness_id');
            $table->dropColumn('appointment_mode_id');
            $table->dropColumn('symptoms_id');
        });
    }
};
