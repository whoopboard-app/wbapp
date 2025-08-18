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
        Schema::create('app_email_templates', function (Blueprint $table) {
            $table->id();
            $table->string('email_id')->unique();
            $table->string('subject_line');
            $table->year('year');
            $table->foreignId('smtp_id')->constrained('smtps')->onDelete('cascade');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->longText('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_email_templates');
    }
};
