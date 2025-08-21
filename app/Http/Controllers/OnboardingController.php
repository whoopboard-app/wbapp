<?php

namespace App\Http\Controllers;

use App\Models\UserOnboarding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    // STEP 1 - Show form
    public function step1()
    {
        return view('onboarding.step1');
    }

    // STEP 1 - Save Goals & Functionalities
    public function storeStep1(Request $request)
    {
        $request->validate([
            'functionalities' => 'required|array',
        ]);

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
        return view('onboarding.step2');
    }

    // STEP 2 - Save Product & User Info
    public function storeStep2(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'current_url'  => 'nullable|string|max:255', // domain only
            'subdomain'    => 'required|string|max:255',
            'full_name'    => 'required|string|max:255',
        ]);
        UserOnboarding::updateOrCreate(
            ['user_id' => Auth::id()], // match by current user
            [
                'product_name'  => $request->product_name,
                'current_url'   => 'https://www.'.$request->current_url,
                'custom_domain' => $request->subdomain, // map correctly
                'full_name'     => $request->full_name,
                'completed'     => true,
            ]
        );

        return redirect()->route('dashboard')
            ->with('success', 'Onboarding Completed!');
    }

}
