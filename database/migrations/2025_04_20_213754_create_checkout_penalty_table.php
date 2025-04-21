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
        Schema::create('checkout_penalty', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checkout_id')->constrained()->onDelete('cascade');
            $table->foreignId('penalty_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 8, 2); // The actual amount charged for this instance
            $table->text('notes')->nullable(); // Optional notes about this specific penalty
            $table->date('assessed_date'); // When the penalty was applied
            $table->date('paid_date')->nullable(); // When the penalty was paid
            $table->foreignId('staff_id')->constrained('users'); // Who assessed the penalty
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_penalty');
    }
};
