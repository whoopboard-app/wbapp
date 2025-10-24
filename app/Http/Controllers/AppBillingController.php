<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanTransaction;

class AppBillingController extends Controller
{
    public function index(Request $request)
    {
        $planTransactions = PlanTransaction::all();
        $count = $planTransactions->count();
        // dd($planTransactions);
        return view('app.billing.index', [
           'planTransactions' => $planTransactions,
            'count' => $count,
        ]);
    }
}
