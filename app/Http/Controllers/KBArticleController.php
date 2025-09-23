<?php

namespace App\Http\Controllers;

use App\Models\Changelog;
use Illuminate\Http\Request;
use App\Models\SettingCategoryChangelog;
use App\Models\ChangelogTag;
use App\Models\KBArticle;
use App\Models\KBBoard;
use App\Models\KBCategory;


class KBArticleController extends Controller
{
    public function index(Request $request)
    {
        $categories = KBCategory::all();
        $tenantId = auth()->user()->tenant_id;
        $announcements = Changelog::where('tenant_id', $tenantId)
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        $filter = $request->get('filter', 'all');
        $search = $request->get('search');

        /*        $query = KBArticle::query();

                if ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                }

                if ($filter !== 'all') {
                    $query->where('status', $filter);
                }

                $kbarticals = $query->latest()->get();*/

        return view('kbarticle.index', compact(/*'kbarticals',*/ 'filter', 'announcements','categories'));
    }

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
            'show_widget' => 'nullable|boolean',
            'link_changelog' => 'required|string',
            'author' => 'required|array|min:1',
            'popular_article' => 'nullable|boolean',
            'list_order' => 'required|string',
            'tagsSelect' => 'required|array|min:1',
            'other_article_category' => 'required|array|min:1',
            'other_article_category2' => 'nullable|array',
            'status' => 'required|string|in:active,inactive,draft',
            'article_banner' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'action' => 'required|string|in:publish,draft',
        ]);

        $validatedData['tenant_id'] = auth()->user()->tenant_id;
        $validatedData['tags'] = $validatedData['tagsSelect'];


        unset($validatedData['tagsSelect']);

        if ($request->hasFile('article_banner')) {
            $path = $request->file('article_banner')->store('article-banners', 'public');
            $validatedData['article_banner'] = $path; // DB me save karne ke liye
        }

        $action = $validatedData['action'];
        // dd($validatedData);
        if ($action === 'publish') {
            $validatedData['status'] = 'active';
            $kbArticle = KBArticle::create($validatedData);
            return redirect()->route('kbarticle.index')->with('success', 'Article published successfully!');
        } elseif ($action === 'draft') {
            $validatedData['status'] = 'draft';
            $kbArticle = KBArticle::create($validatedData);
            return redirect()->route('kbarticle.index')->with('success', 'Article saved as draft successfully!');
        }

    }
    public function storeBoard(Request $request)
    {
        $request->validate([
            'boardName' => 'required|string|max:255',
            'boardDesc' => 'nullable|string|max:500',
            'boardType' => 'required|string',
            'docsType'  => 'required|string',
            'bublicURL' => 'nullable|url',
            'embedCode' => 'nullable|string'
        ]);

        $board = new KBBoard();
        $board->name = $request->boardName;
        $board->description = $request->boardDesc;
        $board->type = $request->boardType;
        $board->docs_type = $request->docsType;
        $board->is_hidden = $request->has('visibility') ? 1 : 0;
        $board->public_url = $request->bublicURL;
        $board->embed_code = $request->embedCode;
        $board->save();

        return redirect()->back()->with('success', 'Board created successfully!');
    }
    public function storeBoardcategory(Request $request)
    {
        dd($request->all());
        $request->validate([
            'categoryName' => 'required|string|max:255',
            'status'       => 'required|string',
            'short_desc'   => 'nullable|string|max:500',
            'imageAdd'     => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $category = new KBCategory();
        $category->name = $request->categoryName;
        $category->short_desc = $request->short_desc;
        $category->status = $request->status;
        $category->parent_id = $request->subCategory ?? null;
        $category->is_hidden = $request->has('visibility') ? 1 : 0;
        $category->is_popular = $request->has('show-widget') ? 1 : 0;

        // Handle image upload
        if ($request->hasFile('imageAdd')) {
            $path = $request->file('imageAdd')->store('categories', 'public');
            $category->image = $path;
        }

        $category->save();

        return redirect()->back()->with('success', 'Category created successfully!');
    }

}
