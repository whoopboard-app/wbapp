<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->json('product_goals')->nullable()->after('subscription_status');
            $table->string('custom_url')->nullable()->unique()->after('product_goals');
            $table->boolean('page_publish')->default(false)->after('custom_url');
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn(['product_goals', 'custom_url', 'page_publish']);
        });
    }
};
