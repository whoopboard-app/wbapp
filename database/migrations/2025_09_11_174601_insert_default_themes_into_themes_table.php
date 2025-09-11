<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('themes')->insert([
            'theme_title' => 'Default Theme',
            'preview_image' => 'default.png',
            'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel metus at erat posuere consectetur et nec nibh. Integer semper pharetra ultricies.',
            'welcome_message' => 'Enable password protection to keep your board private. Subscribers will be verified by email, and only those with access will receive a secure link to view your subdomain.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('themes')->where('name', 'Default Theme')->delete();
    }
};
