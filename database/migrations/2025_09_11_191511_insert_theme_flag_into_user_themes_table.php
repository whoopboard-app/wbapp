<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user_themes', function (Blueprint $table) {
            $table->boolean('theme_flag')
                ->default(0)
                ->comment('0 = default, 1 = customized')
                ->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('user_themes', function (Blueprint $table) {
            $table->dropColumn('theme_flag');
        });
    }
};
