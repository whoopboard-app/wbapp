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
            $table->foreign('tenant_id')->references('tenant_id')->on('tenants')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('kb_categories')->onDelete('cascade');
            $table->unsignedBigInteger('other_article_category')->nullable();
            $table->foreign('other_article_category')
                ->references('id')
                ->on('kb_categories')
                ->onDelete('set null');
            $table->unsignedBigInteger('other_article_category2')->nullable();
            $table->foreign('other_article_category2')
                ->references('id')
                ->on('kb_categories')
                ->onDelete('set null');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->boolean('show_widget')->default(false);
            $table->string('link_changelog')->nullable();
            $table->string('status')->default('draft');
            $table->string('article_banner')->nullable();
            $table->string('action')->nullable();
            $table->json('author')->nullable();
            $table->integer('list_order')->default(1);
            $table->boolean('popular_article')->default(false);
            $table->json('tags')->nullable();
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
