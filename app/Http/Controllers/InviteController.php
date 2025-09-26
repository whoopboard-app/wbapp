<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invite;
use Illuminate\Support\Str;
use App\Mail\InviteMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Stevebauman\Location\Facades\Location;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class InviteController extends Controller
{
    public function create()
    {
        return view('invite.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'email' => 'required|email|unique:invites,email',
            'role' => 'required|string'
        ]);
            
        $invite = Invite::create([
            'first_name' => $request->firstName,
            'email' => $request->email,
            'role' => $request->role,
            'token' => Str::random(32) // Generate a random token
        ]);

        Mail::to($invite->email)->send(new InviteMail($invite));

        return redirect()->route('dashboard')->with('success', 'Invite sent successfully!');
    }

    public function accept($token)
    {
        $invite = Invite::where('token', $token)->firstOrFail();
        return view('invite.accept', compact('invite'));
    }


    public function complete(Request $request)
    {   
        $validated = $request->validate([
            'invite_token' => 'required|exists:invites,token',
            'email'        => 'required|email|exists:invites,email',
            'role'         => 'required|string|in:super_admin,admin,manager,editor',
            'firstName'    => 'required|string|max:255',
            'lastName'    => 'required|string|max:255',
            'profileImg' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'password' => [
                    'required',
                    Password::min(8)
                        ->mixedCase()
                        ->numbers()
                        ->symbols(),
                ],
        ]);
        
        $ip = $request->ip(); // user ka ip
        $location = Location::get($ip);
        $fullName = $validated['firstName'] . ' ' . $validated['lastName'];
        
        $user = User::create([
            'name'       => $validated['firstName'],
            'last_name'  => $validated['lastName'],
            'email'      => $validated['email'],
            'password' => Hash::make($validated['password']),
            'timezone'   => $position->location ?? 'UTC',
            'user_type'  => $validated['role'] ?? 'User',
            'tenant_id'  => null,
        ]);

        $tenant = Tenant::create([
            'client_full_name'     => $fullName,
            'status'               => 'Active Account',
            'subscription_status'  => 'Active',
            'client_user_id'       => $user->id,
            'date_of_registration' => now()->toDateString(),
            'time_of_registration' => now()->toTimeString(),
        ]);

        $user->update([
            'tenant_id' => $tenant->tenant_id,  
        ]);

        event(new Registered($user));

        Auth::login($user);
        return redirect()->route('verification.notice')->with('success', 'Success! Team member invite has been sent.');
    
    }
    
}
