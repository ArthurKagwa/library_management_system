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
        Schema::table('books', function (Blueprint $table) {
            $table->string('category')->nullable()->change(); // Make category nullable
            $table->integer('quantity')->nullable()->change(); // Make quantity nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('category')->nullable(false)->change(); // Revert category to not nullable
            $table->integer('quantity')->nullable(false)->change(); // Revert quantity to not nullable
        });
    }
};
