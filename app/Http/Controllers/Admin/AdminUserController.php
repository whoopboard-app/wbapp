<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminUserController extends Controller
{
    public function index()
    {
        $adminUsers = Admin::all();
        return view('admin.users.index', compact('adminUsers'));
    }
}
