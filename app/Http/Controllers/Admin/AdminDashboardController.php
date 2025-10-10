<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $client_count = User::where('user_type', 1)->count();

        return view('admin.dashboard', compact('client_count'));
    }
}
