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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->dateTime('checked_out_at')->nullable();
            $table->dateTime('due_date');
            $table->dateTime('returned_at')->nullable();
            $table->decimal('fine_amount', 8, 2)->default(0);
            $table->enum('status', ['checked_out', 'returned', 'overdue','reserved'])->default('checked_out');
            $table->timestamps();
            $table->dateTime('pick_up_date');
            $table->index(['user_id', 'book_id']);
            $table->index('due_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
