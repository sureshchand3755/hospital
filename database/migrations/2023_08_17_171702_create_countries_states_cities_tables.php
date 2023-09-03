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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->integer('phonecode');
            $table->tinyInteger('status')->default(0);
            $table->char('deleted_at', 1)->default('N');
            $table->timestamps();
        });

        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('country_id');
            $table->tinyInteger('status')->default(0);
            $table->char('deleted_at', 1)->default('N');
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('state_id');
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
        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');
        Schema::dropIfExists('cities');
    }
};
