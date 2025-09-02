<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingCategoryChangelog;

class ChangelogCategoryController extends Controller
{
    public function index()
    {
        $categories = SettingCategoryChangelog::latest()->get();
        return view('guide_setup.changelog_category', compact('categories'));
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'color_hex'     => 'required|string|max:7',
            'status'        => 'required|in:0,1,2',  // 0=draft, 1=active, 2=inactive
        ]);
        $tenantId = auth()->user()->tenant_id;
        SettingCategoryChangelog::updateOrCreate(
            [
                'category_name' => $request->category_name,
                'tenant_id'     => $tenantId,
            ],
            [
                'color_hex' => $request->color_hex,
                'status'    => $request->status,
            ]
        );
        return redirect()->route('guide.setup.changelog.category')
            ->with('success', 'Category added successfully!');
    }
}
