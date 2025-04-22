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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('book_copy_id')->constrained('book_copies');
            $table->foreignId('reservation_id')->nullable()->constrained();
            $table->foreignId('staff_id')->constrained('users');
            $table->dateTime('checkout_date');
            $table->dateTime('due_date');
            $table->dateTime('return_date')->nullable();
            $table->enum('checkout_condition', ['new', 'good', 'fair', 'poor', 'damaged']);
            $table->enum('return_condition', ['new', 'good', 'fair', 'poor', 'damaged'])->nullable();
            $table->decimal('base_fee', 8, 2);
            $table->integer('renewal_count')->default(0);
            $table->timestamps();
            //fineAmount
            $table->decimal('fine_amount', 8, 2)->default(0.00)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
