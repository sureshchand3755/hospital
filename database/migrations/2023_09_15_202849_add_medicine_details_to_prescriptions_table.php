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
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->after('upload_image', function ($table) {
                $table->integer('medicine_id')->nullable();
                $table->integer('medicine_type_id')->nullable();
                $table->integer('days')->nullable();
                $table->string('af_bf')->nullable();
                $table->string('morning')->nullable();
                $table->string('afternoon')->nullable();
                $table->string('evening')->nullable();
                $table->string('night')->nullable();
                $table->string('remarks')->nullable();
                $table->date('next_consulting_date')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropColumn('medicine_id');
            $table->dropColumn('medicine_type_id');
            $table->dropColumn('days');
            $table->dropColumn('af_bf');
            $table->dropColumn('morning');
            $table->dropColumn('afternoon');
            $table->dropColumn('evening');
            $table->dropColumn('night');
            $table->dropColumn('remarks');
            $table->dropColumn('next_consulting_date');
        });
    }
};
