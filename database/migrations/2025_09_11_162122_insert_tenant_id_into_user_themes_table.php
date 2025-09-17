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
        Schema::table('user_themes', function (Blueprint $table) {
        $table->unsignedBigInteger('tenant_id')->after('id');
        $table->foreign('tenant_id')->references('tenant_id')->on('tenants')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_themes', function (Blueprint $table) {
        $table->dropForeign(['tenant_id']);
        $table->dropColumn('tenant_id');
    });
    }
};
