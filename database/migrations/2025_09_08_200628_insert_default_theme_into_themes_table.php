<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('themes')->insert([
            'name' => 'Default Theme',
            'preview_image' => 'default.png',
            'description' => 'This is the default theme.',
            'is_default' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('themes')->where('name', 'Default Theme')->delete();
    }
};
