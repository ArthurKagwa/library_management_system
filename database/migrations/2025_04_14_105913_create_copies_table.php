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
        Schema::create('book_copies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->string('copy_number');
            $table->enum('status', ['available', 'checked_out', 'reserved', 'in_repair']);
            $table->enum('condition', ['new', 'good', 'fair', 'poor', 'damaged']);
            $table->date('acquisition_date')->nullable();
            $table->string('location')->nullable();
            $table->unique(['book_id', 'copy_number']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_copies');
    }
};
