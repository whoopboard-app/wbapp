<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    use HasFactory;

    protected $table = 'membership_plans';
    protected $fillable = [
        'name', 'type', 'description', 'price_1_month', 'price_3_month', 'price_6_month',
        'price_9_month', 'price_12_month', 'price_3_year', 'price_5_year',
        'total_change_logs', 'total_knowledge_boards', 'total_feedback_boards',
        'total_personas', 'total_research_boards', 'email_sending_limit'
    ];

   
}
