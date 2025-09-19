<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingCategoryChangelog;
use App\Models\ChangelogTag;

class KBArticleController extends Controller
{
    public function create()
    {
        $tenentId = auth()->user()->tenant_id;
        $categories = SettingCategoryChangelog::where('tenant_id', $tenentId)
            ->where('status', '1')
            ->get();

        if ($categories->isEmpty()) {
             $categories = collect([(object)['id' => null, 'category_name' => 'No Categories Found']]);
        }
        
        $tags = ChangelogTag::where('tenant_id', $tenentId)
            ->pluck('tag_name', 'id');

        if ($tags->isEmpty()) {
            $tags = collect([null => 'No Data Found']); // value = 0, label = No Data Found
        }
        return view('kbarticle.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|array|min:1',
            'show_widget'       => 'nullable|boolean',
            'link_changelog'  => 'required|string',
            'author' => 'required|array|min:1',
            'popular_article'       => 'nullable|boolean',
            'list_order'  => 'required|string',
            'tagsSelect' => 'required|array|min:1',
            'other_article_category' => 'required|array|min:1',
            'other_article_category2' => 'nullable|array',
            'status' => 'required|string|in:active,inactive,draft',
            'action' => 'required|string|in:publish,draft',
        ]);
        dd($validatedData);
    }

}
