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
        Schema::create('kb_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')
                  ->references('tenant_id')
                  ->on('tenants')
                  ->onDelete('cascade');
            $table->string('title', 255);
            $table->text('description');
            $table->json('category');  
            $table->boolean('show_widget')->nullable();
            $table->string('link_changelog');
            $table->json('author');                  
            $table->boolean('popular_article')->nullable();
            $table->string('list_order');
            $table->json('tags');              // multiple tags
            $table->json('other_article_category');  // multiple other categories
            $table->json('other_article_category2')->nullable();
            $table->enum('status', ['active','inactive','draft']);
            $table->string('article_banner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kb_articles');
    }
};
