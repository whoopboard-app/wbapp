<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;
use App\Models\Tenant;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);
        $fullName = trim($request->name);
        $parts = preg_split('/\s+/', $fullName);
        $lastName = array_pop($parts);
        $firstName = implode(' ', $parts);
        $position = Location::get($request->ip());
        $user = User::create([
            'name'       => $request->name,
            'last_name'  => $lastName,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'timezone'   => $position->timezone ?? 'UTC',
            'user_type'  => $request->user_type ?? 'User',
            'tenant_id'  => null,
        ]);
        $tenant = Tenant::create([
            'client_full_name'    => $fullName,
            'status'              => 'Active Account',
            'subscription_status' => 'Active',
            'client_user_id'      => $user->id,
            'date_of_registration'=> now()->toDateString(),
            'time_of_registration'=> now()->toTimeString(),
        ]);
        $user->update([
            'tenant_id' => $tenant->tenant_id, // assuming PK is tenant_id
        ]);

        $user->generateVerifyCode();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
