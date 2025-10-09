<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $adminUsers = Admin::all();
        return view('admin.users.index', compact('adminUsers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:admins,email',
            'user_type'  => 'required|in:1,2',
        ]);

        Admin::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'user_type'  => $request->user_type,
            'status'     => '1', // Active
            'password'   => Hash::make('Password@11'),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin user created successfully.');
    }
}
