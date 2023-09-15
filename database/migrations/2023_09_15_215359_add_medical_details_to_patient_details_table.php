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
            $table->after('weight', function ($table) {
                $table->string('temp')->nullable();
                $table->string('bp')->nullable();
                $table->string('pulse')->nullable();
                $table->string('spo2')->nullable();
                $table->string('resp')->nullable();
                $table->string('cbg')->nullable();
                $table->string('medical_ref_by')->nullable();
                $table->string('bmi')->nullable();
                $table->string('pain_scale')->nullable();
                $table->text('symptoms')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_details', function (Blueprint $table) {
            $table->dropColumn('temp');
            $table->dropColumn('bp');
            $table->dropColumn('pulse');
            $table->dropColumn('spo2');
            $table->dropColumn('resp');
            $table->dropColumn('cbg');
            $table->dropColumn('medical_ref_by');
            $table->dropColumn('bmi');
            $table->dropColumn('pain_scale');
            $table->dropColumn('symptoms');
        });
    }
};
