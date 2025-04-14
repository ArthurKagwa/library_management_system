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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('book_id')->constrained();
            $table->foreignId('book_copy_id')->nullable();
            $table->foreignId('staff_id')->nullable()->constrained('users');
            $table->enum('status', ['pending', 'ready_for_pickup', 'picked_up', 'expired', 'cancelled'])->default('pending');
            $table->dateTime('reservation_date');
            $table->dateTime('ready_for_pickup_date')->nullable();
            $table->dateTime('pickup_deadline')->nullable();
            $table->dateTime('actual_pickup_date')->nullable();
            $table->boolean('notification_sent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
