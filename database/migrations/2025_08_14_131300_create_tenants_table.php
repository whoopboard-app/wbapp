<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id('tenant_id');
            $table->string('client_full_name');
            $table->enum('status', ['Active Account', 'Inactive Account', 'Pending Status'])
                ->default('Pending Status');
            $table->enum('subscription_status', ['Active', 'Inactive'])
                ->default('Inactive');
            $table->foreignId('client_user_id')->constrained('users')->onDelete('cascade');
            $table->date('date_of_registration');
            $table->time('time_of_registration');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};

