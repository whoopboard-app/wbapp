<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        return view('auth.verify-email', [
            'expiresAt' => $expiresAt,
        ]);

    }

    /**
     * Verify the email using a verification code.
     */
    
    public function verifyCode(Request $request): RedirectResponse
    {       
        $user = $request->user();  
        $validdata = $request->validate([
            'code' => 'required|string|size:6'
        ]);

        if ($user->isVerifyCodeExpired()) {
            return back()->withErrors(['code' => 'Your verification code has expired.']);
        }

        if ($user->verify_code === $validdata['code'] &&
            $user->isVerifyCodeExpired() === false) {
       
            $user->email_verified_at = now();
            $user->clearVerifyCode();

            return redirect()->intended(route('dashboard', absolute: false));
            
        }

        return redirect()->back()->withErrors(['code' => 'The provided verification code is invalid.']);
    }
}
