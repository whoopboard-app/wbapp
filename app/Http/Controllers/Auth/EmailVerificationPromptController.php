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
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : view('auth.verify-email');
    }

    /**
     * Verify the email using a verification code.
     */
    public function verifyCode(Request $request): RedirectResponse
    {       
        $user = $request->user();  

        if ($user->remember_token === $request->input('code')) {
            $user->email_verified_at = now();
            $user->remember_token = null; // Clear the token after verification
            $user->save();

            return redirect()->route('dashboard', absolute: false)->with('status', 'Email verified successfully.');
        }

        return redirect()->back()->withErrors(['code' => 'The provided verification code is invalid.']);
    }
}
