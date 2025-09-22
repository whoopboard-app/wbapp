<?php

namespace App\Http\Controllers;

use App\Models\ChangelogTag;
use App\Models\Functionality;
use App\Models\SettingCategoryChangelog;
use Illuminate\Http\Request;

class ChangelogTagController extends Controller
{
    /**
     * Show list of tags + form
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tenantId = auth()->user()->tenant_id;
        $tags = ChangelogTag::where('tenant_id', $tenantId)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('tag_name', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(25)
            ->withQueryString();
        $functionalities = Functionality::all();
        if ($request->ajax()) {
            return view('guide_setup.partials.tags_table', compact('tags'))->render();
        }
        return view('guide_setup.changelog_tags', compact('tags', 'functionalities'));
    }

    /**
     * Store a new tag
     */
    public function store(Request $request)
    {
        $request->validate([
            'tag_name' => 'required|string|max:255',
            'short_description' => 'required|string',
            'functionality_id' => 'required|array',
        ]);
        $user = auth()->user();
        $tenantId = $user->tenant_id;
        $tag = ChangelogTag::create([
            'tenant_id' => $tenantId,
            'tag_name' => $request->tag_name,
            'short_description' => $request->short_description,
            'functionality_group' => implode(',', $request->functionality_id),
        ]);
        $user->quick_setup = '1';
        $user->save();
        // Attach functionalities (pivot table)
        $tag->functionalities()->sync($request->functionality_id ?? []);

        return redirect()
            ->route('guide.setup.changelog.tags')
            ->with('success', 'Tag created successfully.');
    }
    /**
     * Show edit form
     */
    public function edit(ChangelogTag $tag)
    {
        $functionalities = Functionality::all();
        $tags = ChangelogTag::where('tenant_id', auth()->user()->tenant_id)
            ->orderBy('id', 'desc')
            ->paginate(3);
        return view('guide_setup.changelog_tags', compact('tag','tags', 'functionalities'))
            ->with('editMode', true);
    }

    /**
     * Update an existing tag
     */
    public function update(Request $request, ChangelogTag $tag)
    {
        $request->validate([
            'tag_name' => 'required|string|max:255',
            'functionality_id' => 'required|exists:functionalities,id',
            'short_description' => 'nullable|string',
        ]);
        $tag->functionalities()->sync($request->functionality_id ?? []);
        $tag->update($request->all());

        return redirect()->route('guide.setup.changelog.tags')
            ->with('success', 'Tag updated successfully.');
    }

    /**
     * Delete a tag
     */
    public function destroy(ChangelogTag $tag)
    {
        $tag->delete();

        return redirect()->route('guide.setup.changelog.tags')
            ->with('success', 'Tag deleted successfully.');
    }
    public function checkName(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $exists = ChangelogTag::where('tenant_id', $tenantId)
            ->whereRaw('LOWER(tag_name) = ?', [strtolower($request->tag_name)])
            ->exists();
        return response()->json(['exists' => $exists]);
    }
}
