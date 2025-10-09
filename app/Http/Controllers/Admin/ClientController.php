<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class ClientController extends Controller
{
    public function index()
    {
        $clients = User::all();
        return view('admin.clients.index', compact('clients'));
    }
}
