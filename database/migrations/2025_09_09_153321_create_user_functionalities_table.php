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
        Schema::create('user_functionalities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('functionality_id');
            $table->string('custom_name')->nullable();
            $table->timestamps();

            // Foreign keys (optional if you want constraints)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('functionality_id')->references('id')->on('functionalities')->onDelete('cascade');

            // If you want to prevent duplicates for same user + functionality
            $table->unique(['user_id', 'functionality_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_functionalities');
    }
};
