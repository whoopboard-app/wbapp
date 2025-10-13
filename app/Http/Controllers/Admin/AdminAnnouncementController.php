<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Changelog;
use App\Models\Tenant;


class AdminAnnouncementController extends Controller
{
    public function index()
    {       
        $announcements = Changelog::with('tenant')->latest()->get();
        
        $announcements->map(function ($announcement) {
            $announcement->client_name = null;

            if ($announcement->tenant && $announcement->tenant->users->isNotEmpty()) {
                $firstUser = $announcement->tenant->users->first();
                $announcement->client_name = $firstUser->name . ' ' . $firstUser->last_name;
            }

            return $announcement;
        });
        return view('admin.announcement.index', compact('announcements'));
    }
}
