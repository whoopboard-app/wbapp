<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Changelog;


class AdminAnnouncementController extends Controller
{
    public function index()
    {       
        $announcements = Changelog::latest()->get();
        // dd($announcements);
        return view('admin.announcement.index', compact('announcements'));
    }
}
