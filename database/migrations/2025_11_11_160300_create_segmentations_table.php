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
        Schema::create('segmentations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_desc')->nullable();
            $table->unsignedBigInteger('status')->default(0);
            $table->unsignedBigInteger('revenue_range_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('age_id')->nullable();
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('plan_type')->nullable();
            $table->unsignedBigInteger('engagement_id')->nullable();
            $table->unsignedBigInteger('frequency_id')->nullable();
            $table->date('signup_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('segmentations');
    }
};
