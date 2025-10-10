<?php

namespace App\Http\Controllers;

use App\Models\Changelog;
use App\Models\ChangelogTag;
use App\Models\SettingCategoryChangelog;
use Illuminate\Http\Request;
use App\Models\UserTheme;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ComingSoonController extends Controller
{
    protected function resolveTenantFromHost()
    {
        $host = request()->getHost();
        $parts = explode('.', $host);

        if (count($parts) >= 3) {
            $subdomain = $parts[0];
        } else {
            $subdomain = null;
        }

        if ($subdomain) {
            $tenant = Tenant::where('custom_url', $subdomain)->first();
            if ($tenant) {
                return $tenant;
            }
        }
        return Tenant::where('page_publish', 1)->first();
    }

    public function show()
    {
        $tenant = $this->resolveTenantFromHost();
        if (!$tenant) {
            abort(404, 'Tenant not found');
        }

        // fetch theme for this tenant
        $theme = UserTheme::where('tenant_id', $tenant->tenant_id)->first();

        if (!$theme || !$theme->is_visible) {
            abort(404);
        }

        // If protection disabled
        if (!$theme->is_password_protected) {
            return view('coming-soon', compact('theme'));
        }

        // If already allowed in session
        if (session('theme_access_' . $tenant->tenant_id)) {
            return redirect()->route('themes.details');
        }

        return view('coming-soon', compact('theme'));
    }

    public function checkPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $tenant = $this->resolveTenantFromHost();
        if (!$tenant) {
            return back()->withErrors(['password' => 'Invalid tenant']);
        }

        $theme = UserTheme::where('tenant_id', $tenant->tenant_id)->first();
        if (!$theme) {
            return back()->withErrors(['password' => 'Invalid access']);
        }
        if (Hash::check($request->password, $theme->password)) {
            session(['theme_access_' . $tenant->tenant_id => true]);
            return redirect()->route('themes.details');
        }

        return back()->withErrors(['password' => 'Incorrect password']);
    }
    public function detailsByTitle($title)
    {
        $tenant = $this->resolveTenantFromHost();
        if (!$tenant) {
            abort(404);
        }

        $theme = UserTheme::where('tenant_id', $tenant->tenant_id)->first();
        if (!$theme) {
            abort(404);
        }

        // Try to find announcement by slug-like comparison
        $announcement = Changelog::where('tenant_id', $tenant->tenant_id)
            ->get()
            ->first(function ($item) use ($title) {
                return Str::slug($item->title) === strtolower($title);
            });

        if (!$announcement) {
            abort(404, 'Announcement not found');
        }

        // Category and tag names
        $catIds = json_decode($announcement->category, true) ?? [];
        $announcement->category_names = SettingCategoryChangelog::whereIn('id', $catIds)
            ->pluck('category_name')
            ->toArray();

        $tagIds = json_decode($announcement->tags, true) ?? [];
        $announcement->tag_names = ChangelogTag::whereIn('id', $tagIds)
            ->pluck('tag_name')
            ->toArray();

        // Previous and next
        $previous = Changelog::where('tenant_id', $tenant->tenant_id)
            ->where('id', '<', $announcement->id)
            ->orderBy('id', 'desc')
            ->first();

        $next = Changelog::where('tenant_id', $tenant->tenant_id)
            ->where('id', '>', $announcement->id)
            ->orderBy('id', 'asc')
            ->first();

        $categories = SettingCategoryChangelog::where('tenant_id', $tenant->tenant_id)
            ->where('status', '1')
            ->get();

        $years = Changelog::selectRaw('YEAR(publish_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('themes.details', compact(
            'theme', 'tenant', 'categories', 'announcement', 'years', 'previous', 'next'
        ));
    }
    public function details(request $request)
    {
        $tenant = $this->resolveTenantFromHost();
        if (!$tenant) {
            abort(404);
        }

        $theme = UserTheme::where('tenant_id', $tenant->tenant_id)->first();
        $tenantId = $tenant->tenant_id;
        $categories = SettingCategoryChangelog::where('tenant_id', $tenantId)
            ->where('status', '1')
            ->get();
        $announcements = Changelog::where('tenant_id', $tenantId)
            ->when(request('category'), function ($query, $categoryId) {
                $query->whereJsonContains('category', (string)$categoryId);
            })
            ->when(request('year'), function ($query, $year) {
                $query->whereYear('publish_date', $year);
            })
            ->when(request('month'), function ($query, $month) {
                $query->whereMonth('publish_date', date('m', strtotime($month)));
            })
            ->orderBy('id', 'desc')
            ->paginate(5);
        $years = Changelog::selectRaw('YEAR(publish_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
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
        if (!$theme) {
            abort(404);
        }
        if ($request->has('announcement_id')) {
            $announcement = Changelog::where('tenant_id', $tenantId)
                ->where('id', $request->announcement_id)
                ->firstOrFail();
            $catIds = json_decode($announcement->category, true) ?? [];
            $announcement->category_names = SettingCategoryChangelog::whereIn('id', $catIds)
                ->pluck('category_name')
                ->toArray();

            $tagIds = json_decode($announcement->tags, true) ?? [];
            $announcement->tag_names = ChangelogTag::whereIn('id', $tagIds)
                ->pluck('tag_name')
                ->toArray();

             $previous = Changelog::where('tenant_id', $tenantId)
                ->where('id', '<', $announcement->id)
                ->orderBy('id', 'desc')
                ->first();

            $next = Changelog::where('tenant_id', $tenantId)
                ->where('id', '>', $announcement->id)
                ->orderBy('id', 'asc')
                ->first();
            return view('themes.details', compact(
                'theme', 'tenant', 'categories', 'announcement', 'years', 'previous', 'next'
            ));
        }
        return view('themes.details', compact('theme', 'announcements', 'categories','years'));
    }
    public function detailsByCategory($slug = null)
    {
        $tenant = $this->resolveTenantFromHost();
        if (!$tenant) abort(404);

        $theme = UserTheme::where('tenant_id', $tenant->tenant_id)->first();
        if (!$theme) abort(404);

        $tenantId = $tenant->tenant_id;
        $categoryId = null;
        if ($slug) {
            $category = SettingCategoryChangelog::where('tenant_id', $tenantId)
                ->whereRaw('LOWER(REPLACE(category_name, " ", "-")) = ?', [strtolower($slug)])
                ->first();
            if ($category) {
                $categoryId = $category->id;
            }
        }
        $announcements = Changelog::where('tenant_id', $tenantId)
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->whereJsonContains('category', (string)$categoryId);
            })
            ->orderBy('id', 'desc')
            ->paginate(5);
        $categories = SettingCategoryChangelog::where('tenant_id', $tenantId)
            ->where('status', '1')
            ->get();

        $years = Changelog::selectRaw('YEAR(publish_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

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

        return view('themes.details', compact('theme', 'tenant', 'categories', 'announcements', 'years'));
    }

}
