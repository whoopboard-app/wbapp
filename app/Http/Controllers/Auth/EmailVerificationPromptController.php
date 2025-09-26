<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $expiresAt = optional($request->user()->verify_code_expire_at)->timestamp ?? 0;
        $user = Auth::user();
        return view('auth.verify-email', [
            'expiresAt' => $expiresAt,
            'user' => $user,
        ]);

    }

    /**
     * Verify the email using a verification code.
     */

    public function verifyCode(Request $request): RedirectResponse
    {
        $user = $request->user();
        $validdata = $request->validate([
            'code' => 'required|digits:6'
        ]);

        if ($user->isVerifyCodeExpired()) {
            return back()->withErrors(['code' => 'Your verification code has expired.']);
        }

        if ($user->verify_code === $validdata['code'] &&
            $user->isVerifyCodeExpired() === false) {

            $user->email_verified_at = now();
            $user->clearVerifyCode();
            if ($user->user_type === 'Account Owner') {
                return redirect()->route('onboarding.step1')
                                ->with('success', 'Your email has been verified!');
            } else {
                return redirect()->route('dashboard')
                                ->with('success', 'Your email has been verified!');
            }
            //            return redirect()->intended(route('dashboard', absolute: false));

        }
        return redirect()->back()->with('error', 'The provided verification code is invalid!');
        // return redirect()->back()->withErrors(['code' => '']);
    }
}
