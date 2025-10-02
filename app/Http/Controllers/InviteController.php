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
        $teamMembers = Invite::where('invited_by_tenant', $tenantId)->latest()
        ->paginate(5);
        $teamCount   = $teamMembers->count();
        return view('invite.create', compact('teamMembers', 'teamCount'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'email' => 'required|email|unique:invites,email|unique:users,email',
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
            'email'        => 'required|email|exists:invites,email|unique:users,email',
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
            'first_name' => $validated['firstName'],
            'status' => 1,
        ]);

        event(new Registered($user));

        Auth::login($user);
        return redirect()->route('verification.notice')->with('success', 'Success! Team member invite has been sent.');
    
    }
    
    public function search(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $query = Invite::where('invited_by_tenant', $tenantId);

        if ($request->filled('search')) {
            $query->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $teamMembers = $query->latest()->paginate(5);
        
        return view('invite.partials.team_table', compact('teamMembers'))->render();
    }

    public function update(Request $request )
    {
        $id = $request->input('id');
        
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'user_type' => 'required|integer|in:1,2,3,4,5',
            'status'    => 'required|in:1,2,3',
        ]);

        // Find the user by ID
        $invite = Invite::findOrFail($id);

        // Update the user's data
        $invite->update([
            'first_name'      => $validatedData['first_name'],
            'user_type' => $validatedData['user_type'],
            'status'    => $validatedData['status'],
        ]);

        return redirect()->route('invite.create')->with('success', 'Team member updated successfully!');
    }

    public function destroy(Invite $invite)
    {
        $invite->delete();
        $user = User::where('email', $invite->email)->first();
        if ($user) {
            $user->delete();
        }
        return redirect()->back()->with('success', 'Member deleted successfully!');
    }

}
