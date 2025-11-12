<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert or update membership plans
        $plans = [
            [
                'id' => 1,
                'name' => 'Free Plan',
                'type' => 'free',
                'description' => 'Basic access with limited features.',
                'price_1_month' => 0.00,
                'price_3_month' => 0.00,
                'price_6_month' => 0.00,
                'price_9_month' => 0.00,
                'price_12_month' => 0.00,
                'price_3_year' => 0.00,
                'price_5_year' => 0.00,
                'total_change_logs' => 10,
                'total_knowledge_boards' => 2,
                'total_feedback_boards' => 1,
                'total_personas' => 1,
                'total_research_boards' => 0,
                'email_sending_limit' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Starter Plan',
                'type' => 'paid',
                'description' => 'Starter plan for small teams.',
                'price_1_month' => 9.99,
                'price_3_month' => 27.99,
                'price_6_month' => 54.99,
                'price_9_month' => 79.99,
                'price_12_month' => 99.99,
                'price_3_year' => 250.00,
                'price_5_year' => 400.00,
                'total_change_logs' => 100,
                'total_knowledge_boards' => 10,
                'total_feedback_boards' => 5,
                'total_personas' => 3,
                'total_research_boards' => 2,
                'email_sending_limit' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Pro Plan',
                'type' => 'paid',
                'description' => 'Advanced plan with more collaboration tools.',
                'price_1_month' => 19.99,
                'price_3_month' => 54.99,
                'price_6_month' => 99.99,
                'price_9_month' => 139.99,
                'price_12_month' => 169.99,
                'price_3_year' => 400.00,
                'price_5_year' => 650.00,
                'total_change_logs' => 500,
                'total_knowledge_boards' => 25,
                'total_feedback_boards' => 10,
                'total_personas' => 5,
                'total_research_boards' => 5,
                'email_sending_limit' => 1500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Enterprise Plan',
                'type' => 'paid',
                'description' => 'All features unlocked with dedicated support.',
                'price_1_month' => 49.99,
                'price_3_month' => 139.99,
                'price_6_month' => 249.99,
                'price_9_month' => 349.99,
                'price_12_month' => 399.99,
                'price_3_year' => 900.00,
                'price_5_year' => 1500.00,
                'total_change_logs' => 2000,
                'total_knowledge_boards' => 50,
                'total_feedback_boards' => 25,
                'total_personas' => 15,
                'total_research_boards' => 10,
                'email_sending_limit' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($plans as $plan) {
            DB::table('membership_plans')->updateOrInsert(
                ['id' => $plan['id']], // check by ID
                $plan
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove the inserted plans if needed
        DB::table('membership_plans')->whereIn('id', [1,2,3,4])->delete();
    }
};
