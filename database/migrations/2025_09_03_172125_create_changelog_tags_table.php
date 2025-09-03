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
        Schema::create('changelog_tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag_name')->default('');
            $table->string('functionality_group')->nullable();
            $table->string('Short_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('changelog_tags');
    }
};
