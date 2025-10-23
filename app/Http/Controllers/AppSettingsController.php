<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invite;

class AppSettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tenantId = $user->tenant_id;
        $totalTeamMembers = Invite::where('invited_by_tenant', $tenantId)->count();
        return view('app-settings.index', compact('user', 'totalTeamMembers'));
    }
}
