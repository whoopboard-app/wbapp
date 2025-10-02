<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();

            $user = Auth::user();
            $tenantSlug = $user->tenant->custom_url ?? null;

            if (!$tenantSlug) {
                return redirect('/')
                    ->with('error', 'No tenant found for your account.');
            }
            $intendedUrl = redirect()->intended()->getTargetUrl();
            if (! str_contains($intendedUrl, "/{$tenantSlug}/")) {
                return redirect()->to(
                    route('dashboard', ['tenant' => $tenantSlug], false)
                )->with('success', 'You are logged in!');
            }
            return redirect()->intended()->with('success', 'You are logged in!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('error', 'Login failed — check your credentials and try again.');
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
