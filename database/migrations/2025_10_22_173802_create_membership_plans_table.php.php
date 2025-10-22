<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->id(); // Plan ID
            $table->string('name'); // Plan Name
            $table->enum('type', ['free', 'paid'])->default('free'); // Plan Type
            $table->text('description')->nullable(); // Plan Description

            // Price Plans
            $table->decimal('price_1_month', 10, 2)->nullable();
            $table->decimal('price_3_month', 10, 2)->nullable();
            $table->decimal('price_6_month', 10, 2)->nullable();
            $table->decimal('price_9_month', 10, 2)->nullable();
            $table->decimal('price_12_month', 10, 2)->nullable();
            $table->decimal('price_3_year', 10, 2)->nullable();
            $table->decimal('price_5_year', 10, 2)->nullable();

            // Usage Limits
            $table->integer('total_change_logs')->default(0);
            $table->integer('total_knowledge_boards')->default(0);
            $table->integer('total_feedback_boards')->default(0);
            $table->integer('total_personas')->default(0);
            $table->integer('total_research_boards')->default(0);
            $table->integer('email_sending_limit')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_plans');
    }
};
