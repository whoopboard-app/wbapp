<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Changelog;
use App\Models\SettingCategoryChangelog;
use App\Models\ChangelogTag;
use Illuminate\Support\Facades\DB;

class ChangelogController extends Controller
{
    public function index()
    {
        $tenentId = auth()->user()->tenant_id;
        $categories = SettingCategoryChangelog::where('tenant_id', $tenentId)
            ->where('status', '1')
            ->get();
        $log_tags = ChangelogTag::where('tenant_id', $tenentId)
            ->first();
        $selectedIds = explode(',', $log_tags->functionality_group);
            
        $tags = DB::table('functionalities')
            ->whereIn('id', $selectedIds)
            ->pluck('name', 'id');

        // This will return the view file
        return view('changelog.add', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {        
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|array|min:1',
            'feedbackRequest' => 'required|string',
            'tagsSelect' => 'required|array|min:1',
            'status' => 'required|string|in:active,inactive,draft',
            'publishDate' => 'required|date',
            'show_widget'       => 'nullable|boolean',
            'send_email'        => 'nullable|boolean',
            'targetSubscriber'  => 'nullable|string|max:255',
            'feature_banner' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            
            'action' => 'required|string|in:publish,draft,schedule',
        ]);

        $validatedData['tenant_id'] = auth()->user()->tenant_id;
        $validatedData['category'] = json_encode($validatedData['category']);
        $validatedData['tags'] = json_encode($validatedData['tagsSelect']);
        $validatedData['show_widget'] = $request->has('show_widget') ? (bool)$validatedData['show_widget'] : false;
        $validatedData['send_email'] = $request->has('send_email') ? (bool)$validatedData['send_email'] : false;
        $validatedData['publish_date'] = $validatedData['publishDate'];
        $validatedData['feedback_request'] = $validatedData['feedbackRequest'];
        unset($validatedData['tagsSelect'], $validatedData['feedbackRequest'], $validatedData['publishDate']);
    
            // Handle file upload for feature_banner
       
        if ($request->hasFile('feature_banner')) {
            $path = $request->file('feature_banner')->store('feature-banners', 'public');
            $validatedData['feature_banner'] = $path; // DB me save karne ke liye
        }
        
        $action = $validatedData['action'];
        if ($action === 'publish') {
            $validatedData['status'] = 'active';
            $changelog = Changelog::create($validatedData);
            return redirect()->route('announcement')->with('success', 'Changelog saved and published successfully!');
        } elseif ($action === 'draft') {
            $validatedData['status'] = 'draft';
            $changelog = Changelog::create($validatedData);
            return redirect()->route('announcement')->with('success', 'Changelog saved as draft successfully!');
        } elseif ($action === 'schedule') {
            dd('Schedule Publish logic here');
        }
        
    }
        
}
