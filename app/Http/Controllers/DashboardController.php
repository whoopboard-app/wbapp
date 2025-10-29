<?php

namespace App\Http\Controllers;

use App\Models\Changelog;
use App\Models\KBBoard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;
        $announcement = Changelog::where('tenant_id', $tenantId)->first();
        $board = KBboard::where('tenant_id', $tenantId)->first();
        return view('dashboard',compact('announcement','board'));
    }
}
