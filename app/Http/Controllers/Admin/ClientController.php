<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class ClientController extends Controller
{
    public function index()
    {
        $clients = User::where('user_type',1)->get();
        return view('admin.clients.index', compact('clients'));
    }
}
