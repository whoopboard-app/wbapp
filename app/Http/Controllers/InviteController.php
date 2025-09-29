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
        $tenantId = auth()->user()->tenant_id;
        $teamMembers = Invite::where('invited_by_tenant', $tenantId)->get();  
        $teamCount   = $teamMembers->count();
        return view('invite.create', compact('teamMembers', 'teamCount'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'email' => 'required|email|unique:invites,email',
            'user_type'    => 'required|integer|in:1,2,3,4',
        ]);

        $tenantId = auth()->user()->tenant_id;
        $userId = auth()->user()->id;
            
        $invite = Invite::create([
            'first_name' => $validatedData['firstName'],
            'email' => $validatedData['email'],
            'user_type' => $validatedData['user_type'],
            'status'  => 3,
            'token' => Str::random(32),
            'invited_by_tenant' => $tenantId,
            'invited_by_user' => $userId,
        ]);

        Mail::to($invite->email)->send(new InviteMail($invite));

        return redirect()->route('invite.create')->with('success', 'Invite sent successfully!');
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
            'user_type'    => 'required|integer|in:1,2,3,4',
            'firstName'    => 'required|string|max:255',
            'lastName'    => 'required|string|max:255',
            'profileImg' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'password' => [
                    'required',
                    Password::min(8)
                        ->mixedCase()
                        ->numbers()
                        ->symbols(),
                ],
        ]);

        $invite = Invite::where('token', $validated['invite_token'])->firstOrFail();
        // dd($invite);

        $profileImgPath = null;

        if ($request->hasFile('profileImg')) {
            $profileImgPath = $request->file('profileImg')->store('profile_images', 'public');
        }
        $ip = $request->ip(); // user ka ip
        $location = Location::get($ip);

      
        $fullName = $validated['firstName'] . ' ' . $validated['lastName'];
        
        $user = User::create([
            'name'       => $validated['firstName'],
            'last_name'  => $validated['lastName'],
            'email'      => $validated['email'],
            'password' => Hash::make($validated['password']),
            'timezone'   => $position->location ?? 'UTC',
            'user_type' => $validated['user_type'] ?? 5,
            'status'  => 1,
            'tenant_id'  => $invite->invited_by_tenant,
            'invited' => true,
            'profile_img' => $profileImgPath,
        ]);

        $invite->update([
            'status' => 1,
        ]);

        event(new Registered($user));

        Auth::login($user);
        return redirect()->route('verification.notice')->with('success', 'Success! Team member invite has been sent.');
    
    }
    
}
