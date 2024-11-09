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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->index();
            $table->string('Name');
            $table->string('registration_number')->unique();
            $table->string('color');
            $table->integer('year')->nullable();
            $table->float('price_per_day')->nullable();
            $table->float('price_per_week')->nullable();
            $table->float('price_per_month')->nullable();
            $table->integer('km_day')->nullable();
            $table->integer('km_week')->nullable();
            $table->integer('km_month')->nullable();
            $table->string('photo_path', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
