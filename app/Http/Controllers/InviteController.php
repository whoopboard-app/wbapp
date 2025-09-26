<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invite;
use Illuminate\Support\Str;
use App\Mail\InviteMail;
use Illuminate\Support\Facades\Mail;


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

        
    
}
