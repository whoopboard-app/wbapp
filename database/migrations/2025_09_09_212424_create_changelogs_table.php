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
        Schema::create('changelogs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')
                  ->references('tenant_id')
                  ->on('tenants')
                  ->onDelete('cascade');

            $table->string('title');
            $table->text('description');

            $table->json('category');
            $table->json('tags');

            $table->string('feedback_request');

            $table->enum('status', ['active', 'inactive', 'draft'])->default('draft');

            $table->date('publish_date');

            $table->boolean('show_widget')->nullable();
            $table->boolean('send_email')->nullable();

            $table->string('target_subscriber')->nullable();

            $table->string('feature_banner')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('changelogs');
    }
};
