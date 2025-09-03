<?php

// database/migrations/xxxx_xx_xx_create_functionalities_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('functionalities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. Announcements, Feedback, etc.
            $table->tinyInteger('status')->default(1); // 1 = Active, 2 = Inactive
            $table->timestamps();
        });

        // Insert default functionalities
        DB::table('functionalities')->insert([
            ['name' => 'Announcement', 'status' => 1],
            ['name' => 'Feedback', 'status' => 1],
            ['name' => 'Product Road Map', 'status' => 1],
            ['name' => 'Testimonials', 'status' => 1],
            ['name' => 'Knowledge Board', 'status' => 1],
        ]);
    }

    public function down(): void {
        Schema::dropIfExists('functionalities');
    }
};
