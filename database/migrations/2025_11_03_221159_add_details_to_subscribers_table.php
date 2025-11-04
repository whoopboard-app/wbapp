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
        Schema::table('subscribers', function (Blueprint $table) {
            $table->string('linkedin_url')->nullable()->after('email');
            $table->dateTime('subscribe_date')->nullable()->after('linkedin_url');
            $table->string('short_desc', 300)->nullable()->after('subscribe_date');
            $table->json('userSegments')->nullable()->after('short_desc'); // store as JSON
            $table->string('addType')->nullable()->after('userSegments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropColumn([
                'linkedin_url',
                'subscribe_date',
                'short_desc',
                'userSegments',
                'addType'
            ]);
        });
    }
};
