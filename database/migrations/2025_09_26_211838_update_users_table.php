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
            $table->dropColumn(['user_type', 'status']);
            $table->tinyInteger('user_type')->default(5)->after('email');
            $table->enum('status', ['1', '2', '3'])->after('user_type')->default('1');
            $table->string('profile_img')->nullable()->after('status');
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop new columns
            if (Schema::hasColumn('users', 'user_type')) {
                $table->dropColumn('user_type');
            }
            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('users', 'profile_img')) {
                $table->dropColumn('profile_img');
            }

            // Re-create old columns
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
        });
    }
};
