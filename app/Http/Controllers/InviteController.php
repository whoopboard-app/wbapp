<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invite;

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
        
        Invite::create([
            'first_name' => $request->firstName,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('dashboard')->with('success', 'Invite sent successfully!');
    }

        
    
}
