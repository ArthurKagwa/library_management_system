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
        Schema::create('lending_fees', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->integer('duration_days');
            $table->decimal('fee_amount', 8, 2);
            $table->date('effective_from')->default(now());
            $table->date('effective_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lending_fees');
    }
};
