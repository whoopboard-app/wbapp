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
        Schema::table('plan_transactions', function (Blueprint $table) {
            $table->bigInteger('status')->default(0)->after('amount'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_transactions', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
