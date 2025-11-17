<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('segmentations', function (Blueprint $table) {
            // Add tenant_id (nullable if old data exists)
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');

            // Add foreign key constraint
            $table->foreign('tenant_id')
                  ->references('id')
                  ->on('tenants')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('segmentations', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropColumn('tenant_id');
        });
    }
};
