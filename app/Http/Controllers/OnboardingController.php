<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use App\Models\UserOnboarding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GlobalProduct;

class OnboardingController extends Controller
{
    // STEP 1 - Show form
    public function step1()
    {
        $products = GlobalProduct::where('status', 'active')->get();
        return view('onboarding.step1', compact('products'));
    }

    // STEP 1 - Save Goals & Functionalities
    public function storeStep1(Request $request)
    {
        $request->validate([
            'functionalities' => 'required|array',
        ]);
        $tenant = auth()->user()->tenant;
        if ($tenant) {
        $tenant->product_goals = implode(',', $request->functionalities);
        $tenant->save();
            }
        $onboarding = UserOnboarding::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'functionalities' => json_encode($request->functionalities),
            ]
        );

        return redirect()->route('onboarding.step2');
    }
    // STEP 2 - Show form
    public function step2()
    {
        $user = Auth::user();
        return view('onboarding.step2', compact('user'));
    }

    // STEP 2 - Save Product & User Info
    public function storeStep2(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'current_url'  => 'nullable|string|max:255',
            'subdomain'    => 'required|string|max:255',
            'full_name'    => 'required|string|max:255',
        ]);
        $tenant = Tenant::updateOrCreate(
            ['client_user_id' => Auth::id()],
            [
                'website_url'      => $request->current_url ? 'https://www.' . $request->current_url : null,
                'custom_url'       => $request->subdomain,
                'client_full_name' => $request->full_name,
                'page_publish'     => 1,
                'status'           => 'Active Account',
                'subscription_status' => 'Active',
            ]
        );
        $user = Auth::user();
        $user->tenant_id = $tenant->tenant_id;
        $user->name = $request->full_name;
        $user->save();
        $tenant->save();
        // Update onboarding record
        UserOnboarding::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'product_name'     => $request->product_name,
                'website_url'      => $request->current_url ? 'https://www.' . $request->current_url : null,
                'custom_url'       => $request->subdomain,
                'client_full_name' => $request->full_name,
                'page_publish'     => 1,
            ]
        );

        return redirect()->route('guide_setup')
            ->with('success', 'Onboarding Completed!');
    }
    public function checkDomain(Request $request)
    {
        $request->validate([
            'subdomain' => 'required|string|alpha_dash',
        ]);

        $exists = Tenant::where('custom_url', $request->subdomain)->exists();

        if ($exists) {
            return response()->json(['available' => false, 'message' => 'Oops! This extension is not available. Please try a different name.']);
        }

        return response()->json(['available' => true, 'message' => 'The following domain extension is available.']);
    }


}
