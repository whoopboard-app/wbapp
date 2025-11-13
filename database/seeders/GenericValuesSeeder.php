<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenericValuesSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['type' => 'gv_revenuerange', 'value' => '$101 to $500', 'status' => 1],
            ['type' => 'gv_revenuerange', 'value' => '$501 to $999', 'status' => 1],
            ['type' => 'gv_revenuerange', 'value' => '$1000+', 'status' => 1],
            ['type' => 'gv_location', 'value' => 'Asia', 'status' => 1],
            ['type' => 'gv_location', 'value' => 'Europe', 'status' => 1],
            ['type' => 'gv_location', 'value' => 'North America', 'status' => 1],
            ['type' => 'gv_agerange', 'value' => '18-25', 'status' => 1],
            ['type' => 'gv_agerange', 'value' => '26-35', 'status' => 1],
            ['type' => 'gv_agerange', 'value' => '36-45', 'status' => 1],
            ['type' => 'gv_gender', 'value' => 'Male', 'status' => 1],
            ['type' => 'gv_gender', 'value' => 'Female', 'status' => 1],
            ['type' => 'gv_language', 'value' => 'English', 'status' => 1],
            ['type' => 'gv_language', 'value' => 'Urdu', 'status' => 1],
            ['type' => 'gv_usetype', 'value' => 'Customer', 'status' => 1],
            ['type' => 'gv_usetype', 'value' => 'Admin', 'status' => 1],
            ['type' => 'gv_englevel', 'value' => 'Low', 'status' => 1],
            ['type' => 'gv_englevel', 'value' => 'High', 'status' => 1],
            ['type' => 'gv_usagefre', 'value' => 'Daily', 'status' => 1],
            ['type' => 'gv_usagefre', 'value' => 'Weekly', 'status' => 1],
            ['type' => 'gv_plan_type', 'value' => 'Free', 'status' => 1],
            ['type' => 'gv_plan_type', 'value' => 'Basic', 'status' => 1],
            ['type' => 'gv_plan_type', 'value' => 'Premium', 'status' => 1],
            ['type' => 'gv_plan_type', 'value' => 'Enterprise', 'status' => 1],
        ];

        // created_at aur updated_at null rahenge
        foreach ($data as &$item) {
            $item['created_at'] = null;
            $item['updated_at'] = null;
        }

        DB::table('generic_values')->insert($data);
    }
}
