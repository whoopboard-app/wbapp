<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('changelog_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->after('id');
            $table->foreign('tenant_id')->references('tenant_id')->on('tenants')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('changelog_tags', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropColumn('tenant_id');
        });
    }

};
