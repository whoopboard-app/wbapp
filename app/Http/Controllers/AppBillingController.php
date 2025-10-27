<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanTransaction;
use App\Models\MembershipPlan;

class AppBillingController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id; 
        $planTransactions = PlanTransaction::where('tenant_id', $tenantId)->with('membershipPlan')->get();
        $plans = MembershipPlan::all();
        // dd($planTransactions->membershipPlan->name);
        // dd($plans);
        $count = $planTransactions->count();
        $currentTransaction = PlanTransaction::where('tenant_id', $tenantId)
            ->latest('transaction_date')
            ->first();
        $currentPlan = $currentTransaction 
            ? MembershipPlan::find($currentTransaction->plan_id) 
            : null;
        return view('app-settings.billing.index', [
           'planTransactions' => $planTransactions,
            'count' => $count,
            'plans' => $plans,
            'currentPlan' => $currentPlan,
        ]);
    }
    public function delete(Request $request)
    {
        $request->validate([
            'reason' => 'required|string',
        ]);

        return redirect()->route('billing.index')->with('success', 'Success! Deleted successfully.');
    }
    
}
