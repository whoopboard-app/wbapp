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
            $table->string('feature_banner')->nullable()->after('theme_flag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_themes', function (Blueprint $table) {
            $table->dropColumn('feature_banner');
        });
    }
};
