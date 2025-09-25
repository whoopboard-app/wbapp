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
        Schema::table('kb_categories', function (Blueprint $table) {
            $table->foreignId('board_id')->constrained('kb_boards')->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->after('board_id')->constrained('kb_categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kb_categories', function (Blueprint $table) {
            $table->dropForeign(['board_id']);
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['board_id', 'parent_id']);
        });
    }
};
