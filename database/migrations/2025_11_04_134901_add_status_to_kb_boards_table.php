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
        Schema::table('kb_boards', function (Blueprint $table) {
            $table->tinyInteger('status')->after('is_hidden')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kb_boards', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
