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
        Schema::table('invites', function (Blueprint $table) {
            // Drop old 'role' column
            $table->dropColumn('role');

            // Add 'user_type' as tiny integer (1-5)
            $table->tinyInteger('user_type')->default(5)->after('email');
            $table->unsignedBigInteger('invited_by_tenant')->nullable()->after('user_type');
            $table->unsignedBigInteger('invited_by_user')->nullable()->after('invited_by_tenant');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invites', function (Blueprint $table) {
            $table->dropColumn('user_type');
            $table->dropColumn('invited_by_user');
            $table->dropColumn('invited_by_tenant');
            $table->string('role')->nullable()->after('email');
        });
    }
};
