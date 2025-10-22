<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user who purchased
            $table->foreignId('plan_id')->constrained('membership_plans')->onDelete('cascade'); // linked plan

            $table->string('invoice_number')->unique();
            $table->date('transaction_date');
            $table->string('transaction_id')->nullable();
            $table->enum('payment_type', ['stripe', 'paypal', 'linkit'])->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->date('next_due_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_transactions');
    }
};
