<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Changelog;
use App\Models\SettingCategoryChangelog;
use App\Models\ChangelogTag;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ChangelogController extends Controller
{
    public function list()
    {
        $tenantId = auth()->user()->tenant_id;


        $categories = SettingCategoryChangelog::where('tenant_id', $tenantId)
        ->where('status', '1')
        ->get();

        $announcements = Changelog::where('tenant_id', $tenantId)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $totalCount = $announcements->total();

        foreach ($announcements as $log) {
            $catIds = json_decode($log->category, true) ?? [];
            $log->category_names = SettingCategoryChangelog::whereIn('id', $catIds)
                ->pluck('category_name')
                ->toArray();

            $tagIds = json_decode($log->tags, true) ?? [];
            $log->tag_names = ChangelogTag::whereIn('id', $tagIds)
                ->pluck('tag_name')
                ->toArray();
        }
        return view('announcement', compact('announcements', 'categories', 'totalCount'))->with('filter', 'all');
    }

   public function filter(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $search = $request->search;
        $status = $request->status;

        $announcements = Changelog::where('tenant_id', $tenantId)
            ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
            ->when($status, fn($q) => $q->where('status', $status))
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        foreach ($announcements as $log) {
            $catIds = json_decode($log->category, true) ?? [];
            $log->category_names = SettingCategoryChangelog::whereIn('id', $catIds)
                ->pluck('category_name')
                ->toArray();

            $tagIds = json_decode($log->tags, true) ?? [];
            $log->tag_names = ChangelogTag::whereIn('id', $tagIds)
                ->pluck('tag_name')
                ->toArray();
        }

        return view('changelog.partials.announcement_cards', compact('announcements'))->render();
    }


    public function index()
    {
        $tenentId = auth()->user()->tenant_id;
        $categories = SettingCategoryChangelog::where('tenant_id', $tenentId)
            ->where('status', '1')
            ->get();

        if ($categories->isEmpty()) {
            // $categories = collect([['id' => null, 'category_name' => 'No Categories Found']]);
             $categories = collect([(object)['id' => null, 'category_name' => 'No Categories Found']]);
        }

        $tags = ChangelogTag::where('tenant_id', $tenentId)
            ->pluck('tag_name', 'id');

        if ($tags->isEmpty()) {
            $tags = collect([null => 'No Data Found']);
        }

        return view('changelog.add', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'long_description' => 'required|string',
            'categorySelect' => 'required|array|min:1',
            // 'feedbackRequest' => 'required|string',
            'tagsSelect' => 'required|array|min:1',
            'status' => 'required|string|in:active,inactive,draft,schedule',
            'publishDate' => 'required|date',
            'show_widget'       => 'nullable|boolean',
            'send_email'        => 'nullable|boolean',
            'targetSubscriber'  => 'nullable|string|max:255',
            'feature_banner' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',

            'action' => 'required|string|in:publish,draft,schedule',
        ]);
        $validatedData['publishDate'] = Carbon::parse($validatedData['publishDate'])->format('Y-m-d');

        $validatedData['tenant_id'] = auth()->user()->tenant_id;
        $validatedData['category'] = json_encode($validatedData['categorySelect']);
        $validatedData['tags'] = json_encode($validatedData['tagsSelect']);
        $validatedData['show_widget'] = $request->has('show_widget') ? (bool)$validatedData['show_widget'] : false;
        $validatedData['send_email'] = $request->has('send_email') ? (bool)$validatedData['send_email'] : false;
        $validatedData['publish_date'] = $validatedData['publishDate'];

        unset($validatedData['tagsSelect'], $validatedData['publishDate']);

        if ($request->hasFile('feature_banner')) {
            $path = $request->file('feature_banner')->store('feature-banners', 'public');
            $validatedData['feature_banner'] = $path; // DB me save karne ke liye
        }
        $action = $validatedData['action'];

        if ($action === 'publish') {
            $changelog = Changelog::create($validatedData);
            return redirect()->route('announcement.show', $changelog->id)
                ->with('success', 'Announcement saved and published successfully!');
        }
        elseif ($action === 'draft') {
            $validatedData['status'] = 'draft';
            $changelog = Changelog::create($validatedData);
            return redirect()->route('announcement.show', $changelog->id)
                ->with('success', 'Announcement saved as draft successfully!');
        }
        elseif ($action === 'schedule') {
            $validatedData['status'] = 'schedule';
            $changelog = Changelog::create($validatedData);
            return redirect()->route('announcement.show', $changelog->id)
                ->with('success', 'Announcement scheduled successfully!');
        }
    }
    public function edit($id)
    {
        $tenentId = auth()->user()->tenant_id;
        $announcement = Changelog::findOrFail($id);
        $categories = SettingCategoryChangelog::where('tenant_id', $tenentId)
            ->where('status', '1')
            ->get();

        if ($categories->isEmpty()) {
            $categories = collect([(object)['id' => null, 'category_name' => 'No Categories Found']]);
        }

        $tags = ChangelogTag::where('tenant_id', $tenentId)
            ->pluck('tag_name', 'id');
        if ($tags->isEmpty()) {
            $tags = collect([null => 'No Data Found']);
        }
        return view('changelog.add', compact('announcement','categories', 'tags'));
    }
    public function update(Request $request){
            $announcement = Changelog::findOrFail($request->id);

            // Validate input
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'categorySelect' => 'required|array|min:1',
                'tagsSelect' => 'required|array|min:1',
                'status' => 'required|string|in:active,inactive,draft,schedule',
                'publishDate' => 'required|date',
                'show_widget' => 'nullable|boolean',
                'send_email' => 'nullable|boolean',
                'targetSubscriber' => 'nullable|string|max:255',
                'feature_banner' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
                'action' => 'required|string|in:publish,draft,schedule',
            ]);

            $validatedData['publishDate'] = Carbon::parse($validatedData['publishDate'])->format('Y-m-d');
            $validatedData['tenant_id'] = auth()->user()->tenant_id;
            $validatedData['category'] = json_encode($validatedData['categorySelect']);
            $validatedData['tags'] = json_encode($validatedData['tagsSelect']);
            $validatedData['show_widget'] = $request->has('show_widget') ? (bool)$validatedData['show_widget'] : false;
            $validatedData['send_email'] = $request->has('send_email') ? (bool)$validatedData['send_email'] : false;
            $validatedData['publish_date'] = $validatedData['publishDate'];

            unset($validatedData['tagsSelect'], $validatedData['publishDate']);

            if ($request->hasFile('feature_banner')) {
                if ($announcement->feature_banner && Storage::disk('public')->exists($announcement->feature_banner)) {
                    Storage::disk('public')->delete($announcement->feature_banner);
                }
                $path = $request->file('feature_banner')->store('feature-banners', 'public');
                $validatedData['feature_banner'] = $path;
            } else {
                $validatedData['feature_banner'] = $announcement->feature_banner;
            }
            $action = $validatedData['action'];
            if ($action === 'publish') {
                $validatedData['status'] = 'active';
            } elseif ($action === 'draft') {
                $validatedData['status'] = 'draft';
            } elseif ($action === 'schedule') {
                $validatedData['status'] = 'schedule';
            }
            $announcement->update($validatedData);
        return redirect()->route('announcement.show', $announcement->id)
            ->with('success', 'Announcement scheduled successfully!');
    }

    public function show($id)
    {
        $tenantId = auth()->user()->tenant_id;

        $changelog = Changelog::where('tenant_id', $tenantId)->findOrFail($id);

        $catIds = json_decode($changelog->category, true) ?? [];
        $changelog->category_names = SettingCategoryChangelog::whereIn('id', $catIds)
            ->pluck('category_name')
            ->toArray();

        $tagIds = json_decode($changelog->tags, true) ?? [];
        $changelog->tag_names = ChangelogTag::whereIn('id', $tagIds)
            ->pluck('tag_name')
            ->toArray();

        return view('changelog.view', compact('changelog'));
    }
    public function destroy($id)
    {
        $announcement = Changelog::findOrFail($id);
        if ($announcement->feature_banner && Storage::disk('public')->exists($announcement->feature_banner)) {
            Storage::disk('public')->delete($announcement->feature_banner);
        }
        $announcement->delete();
        return redirect()
            ->route('announcement.list')
            ->with('success', 'Announcement deleted successfully!');
    }
}
