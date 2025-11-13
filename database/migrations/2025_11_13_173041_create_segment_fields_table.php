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
        Schema::dropIfExists('segment_fields');
        Schema::create('segment_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_name');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('segment_fields')->insert([
            [
                'field_name' => 'Revenue Range',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'field_name' => 'User Type / Role',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'field_name' => 'Plan Type / Subscription Tier',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('segment_fields');
    }
};
