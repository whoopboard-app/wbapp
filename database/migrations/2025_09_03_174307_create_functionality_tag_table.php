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
        Schema::create('functionality_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('changelog_tag_id')->constrained()->onDelete('cascade');
            $table->foreignId('functionality_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['changelog_tag_id', 'functionality_id'], 'tag_func_unique');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('functionality_tag');
    }
};
