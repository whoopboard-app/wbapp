<?php

namespace App\Http\Controllers;

use App\Models\Changelog;
use Illuminate\Http\Request;
use App\Models\SettingCategoryChangelog;
use App\Models\ChangelogTag;
use App\Models\KBArticle;
use App\Models\KBBoard;
use App\Models\User;
use App\Models\KBCategory;


class KBArticleController extends Controller
{
    public function index(Request $request)
    {
        $boards = KBBoard::all();
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

        return view('kbarticle.index', compact(/*'kbarticals',*/ 'filter', 'announcements','categories','boards'));
    }

    public function create()
    {
        $tenantId = auth()->user()->tenant_id;
        $boards = KBBoard::with(['categories.articles'])
            ->where('tenant_id', $tenantId)
            ->get();
        $authors = User::where('tenant_id', $tenantId)->get();
        $categories = KBCategory::with('board')
        ->where('tenant_id', $tenantId)
            ->where('status', 1)
            ->get();

        if ($categories->isEmpty()) {
            $categories = collect([(object)['id' => null, 'category_name' => 'No Categories Found']]);
        }

        $tags = ChangelogTag::where('tenant_id', $tenantId)
            ->pluck('tag_name', 'id');

        if ($tags->isEmpty()) {
            $tags = collect([null => 'No Data Found']);
        }
        return view('kbarticle.create', compact('categories', 'tags','boards','authors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'                  => 'required|string|max:255',
            'description'            => 'required|string',
            'category_id'            => 'required|integer|exists:kb_categories,id',
            'show_widget'            => 'nullable|boolean',
            'link_changelog'         => 'nullable|string',
            'author'                 => 'required|array|min:1',
            'popular_article'        => 'nullable|boolean',
            'list_order'             => 'required|integer',
            'tagsSelect'             => 'required|array|min:1',
            'other_article_category' => 'nullable|integer|exists:kb_categories,id',
            'other_article_category2'=> 'nullable|integer|exists:kb_categories,id',
            'status'                 => 'required|string|in:active,inactive,draft',
            'article_banner'         => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'action'                 => 'required|string|in:publish,draft',
        ]);
        $validatedData['tenant_id'] = auth()->user()->tenant_id;
        $validatedData['tags']   = json_encode($validatedData['tagsSelect']);
        unset($validatedData['tagsSelect']);

        $validatedData['author'] = json_encode($validatedData['author']);
        if ($request->hasFile('article_banner')) {
            $path = $request->file('article_banner')->store('article_banners', 'public');
            $validatedData['article_banner'] = $path;
        }
        if ($validatedData['action'] === 'publish') {
            $validatedData['status'] = 'active';
        } elseif ($validatedData['action'] === 'draft') {
            $validatedData['status'] = 'draft';
        }
        unset($validatedData['action']);
        KBArticle::create($validatedData);

        return redirect()->route('kb_articles.index')
            ->with('success', 'Article created successfully.');
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
        $tenantId = auth()->user()->tenant_id;
        $board = new KBBoard();
        $board->tenant_id = $tenantId;
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
        $request->validate([
            'board_id'     => 'required|exists:kb_boards,id',
            'categoryName' => 'required|string|max:255',
            'status'       => 'required|string',
            'short_desc'   => 'nullable|string|max:500',
            'imageAdd'     => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'parent_id' => 'nullable|exists:kb_categories,id',
        ]);

        $category = new KBCategory();
        $category->parent_id  = $request->parent_id ?? null;
        $category->board_id   = $request->board_id;
        $category->name       = $request->categoryName;
        $category->short_desc = $request->short_desc;
        $category->status     = $request->status;
        $category->parent_id  = $request->parent_id ?? null;
        $category->is_hidden  = $request->has('visibility') ? 1 : 0;
        $category->is_popular = $request->has('is_popular') ? 1 : 0;

        if ($request->hasFile('imageAdd')) {
            $path = $request->file('imageAdd')->store('categories', 'public');
            $category->image = $path;
        }

        $category->save();

        return redirect()->back()->with('success', 'Category created successfully!');
    }
    public function getBoardCategories($boardId)
    {
        $board = KBBoard::with(['categories.articles'])->findOrFail($boardId);
        return view('kbarticle.kbcategories', compact('board'));
    }
    public function destroyBoard($id)
    {
        $board = KBBoard::findOrFail($id);
        $board->delete();
        return redirect()->route('kbarticle.index')->with('success', 'Board deleted successfully!');
    }
    public function showArticle($categoryId)
    {
        $category = KBCategory::with('children')->findOrFail($categoryId);
        $board = $category->board;
        $allCategoryIds = $this->getAllCategoryIds($category);
        $articles = KBArticle::with('category')
            ->whereIn('category_id', $allCategoryIds)
            ->orderBy('list_order', 'asc')
            ->paginate(15);

        return view('kbarticle.kbarticles', compact('articles', 'category','board','allCategoryIds'));
    }

    /**
     * Recursive helper to collect child category IDs
     */
    private function getAllCategoryIds($category)
    {
        $ids = [$category->id];

        foreach ($category->children as $child) {
            $ids = array_merge($ids, $this->getAllCategoryIds($child));
        }

        return $ids;
    }
    public function sort(Request $request)
    {
        $order = $request->input('order', []);

        if (!empty($order)) {
            foreach ($order as $item) {
                \App\Models\KBArticle::where('id', $item['id'])
                    ->update(['list_order' => $item['position']]);
            }
        }

        return response()->json(['success' => true]);
    }






}
