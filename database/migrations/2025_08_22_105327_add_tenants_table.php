<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('tenants');

        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('tenant_id');
            $table->string('subdomain')->nullable()->index();
            $table->string('client_full_name');   // varchar(191)

            $table->enum('status', ['Active Account', 'Inactive Account', 'Pending Status'])
                ->default('Pending Status');

            $table->enum('subscription_status', ['Active', 'Inactive'])
                ->default('Inactive');

            $table->json('product_goals')->nullable();

            $table->string('custom_url')->nullable()->index();

            $table->boolean('page_publish')->default(0);

            $table->unsignedBigInteger('client_user_id')->index();

            $table->date('date_of_registration')->nullable();
            $table->time('time_of_registration');

            $table->timestamps();

            $table->json('data')->nullable();

            $table->string('website_url')->nullable();

            // Optional: Foreign key constraint to users table
            $table->foreign('client_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
