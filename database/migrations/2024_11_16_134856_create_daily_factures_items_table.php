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
        Schema::create('daily_factures_items', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->index();
            $table->unsignedBigInteger('facture_id');
            $table->foreign('facture_id')->references('id')->on('daily_factures')->onDelete('cascade');

            $table->unsignedBigInteger('cars_id');
            $table->foreign('cars_id')->references('id')->on('cars')->onDelete('cascade');
            $table->string("reservation_id")->nullable();
            $table->decimal('price', 10, 2); // Allow prices with decimal values
            $table->boolean('is_price'); // Transaction type: 0 for outcome, 1 for income
            $table->text('description')->nullable(); // Description of the item
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_factures_items');
    }
};
