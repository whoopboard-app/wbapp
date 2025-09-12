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
        Schema::dropIfExists('themes');
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('brand_color', 10)->default('#f44336');
            $table->string('theme_title')->nullable();
            $table->string('welcome_message')->nullable();
            $table->string('short_description')->nullable();
            $table->string('preview_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
