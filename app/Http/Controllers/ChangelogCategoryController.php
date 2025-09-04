<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingCategoryChangelog;

class ChangelogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = SettingCategoryChangelog::where('tenant_id', auth()->user()->tenant_id);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('category_name', 'like', "%{$search}%");
        }
        $categories = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
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
    public function edit(SettingCategoryChangelog $category)
    {
        $categories = SettingCategoryChangelog::where('tenant_id', auth()->user()->tenant_id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('guide_setup.changelog_category', compact('category', 'categories'));
    }
    public function update(Request $request, SettingCategoryChangelog $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'color_hex'     => 'required|string|max:7',
            'status'        => 'required|in:0,1,2',
        ]);

        $category->update([
            'category_name' => $request->category_name,
            'color_hex'     => $request->color_hex,
            'status'        => $request->status,
            'tenant_id'     => auth()->user()->tenant_id
        ]);

        return redirect()->route('guide.setup.changelog.category')->with('success', 'Category updated successfully!');
    }
    public function destroy($id)
    {
        $category = SettingCategoryChangelog::findOrFail($id);
        $category->delete();

        return redirect()->route('guide.setup.changelog.category')
            ->with('success', 'Category deleted successfully!');
    }

}
