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
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->after('name')->nullable();
            $table->string('timezone')->after('password')->nullable();
            $table->enum('user_type', [
                'Account Owner',
                'Administration',
                'User',
                'Editor',
                'Manager'
            ])->after('timezone')->default('User');

            $table->enum('status', [
                'Active',
                'Inactive',
                'Pending'
            ])->after('user_type')->default('Active');

            $table->unsignedBigInteger('tenant_id')->after('status')->nullable();
            $table->foreign('tenant_id')->references('tenant_id')->on('tenants')->onDelete('set null');
            $table->string('verify_code')->nullable()->after('remember_token');
            $table->timestamp('verify_code_expire_at')->nullable()->after('verify_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('timezone');
            $table->dropColumn('user_type');
            $table->dropColumn('status');
            $table->dropForeign(['tenant_id']);
            $table->dropColumn('tenant_id');
            $table->dropColumn('verify_code');
            $table->dropColumn('verify_code_expire_at');

        });
    }
};
