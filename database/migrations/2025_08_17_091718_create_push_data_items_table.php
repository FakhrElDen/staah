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
        Schema::create('push_data_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('push_data_id')->constrained('push_data')->onDelete('cascade');

            $table->date('from_date');
            $table->date('to_date');

            $table->integer('inventory')->nullable();
            $table->integer('min_stay')->nullable();
            $table->integer('max_stay')->nullable();
            $table->integer('min_stay_through')->nullable();
            $table->integer('max_stay_through')->nullable();

            $table->string('cta', 5)->nullable();      // Close to Arrival (Y/N)
            $table->string('ctd', 5)->nullable();      // Close to Departure (Y/N)
            $table->string('stop_sell', 5)->nullable(); // Stop sell (Y/N)

            $table->json('amount_before_tax')->nullable();
            $table->json('amount_after_tax')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('push_data_items');
    }
};
