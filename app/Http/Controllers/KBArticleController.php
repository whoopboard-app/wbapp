<?php

namespace App\Http\Controllers;

use App\Models\Changelog;
use Illuminate\Http\Request;
use App\Models\ChangelogTag;
use App\Models\KBArticle;
use App\Models\KBBoard;
use App\Models\KBCategory;
use App\Models\User;

class KBArticleController extends Controller
{
    public function create()
    {
        $tenantId = auth()->user()->tenant_id;
        $boards = KBBoard::with('categories.articles')->where('tenant_id', $tenantId)->get();
        $authors = User::where('tenant_id', $tenantId)->get();
        $categories = KBCategory::with('board')->where('tenant_id', $tenantId)->where('status', 1)->get();
        $tags = ChangelogTag::where('tenant_id', $tenantId)->pluck('tag_name', 'id');

        if ($categories->isEmpty()) {
            $categories = collect([(object)['id' => null, 'category_name' => 'No Categories Found']]);
        }
        if ($tags->isEmpty()) {
            $tags = collect([null => 'No Data Found']);
        }

        return view('kbarticle.create', compact('categories', 'tags', 'boards', 'authors'));
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
        $validatedData['tag_ids'] = implode(',', $request->tagsSelect);
        $validatedData['author'] = json_encode($validatedData['author']);

        if ($request->hasFile('article_banner')) {
            $validatedData['article_banner'] = $request->file('article_banner')->store('article_banners', 'public');
        }

        $validatedData['status'] = $validatedData['action'] === 'publish' ? 'active' : 'draft';
        unset($validatedData['action']);

        $article = KBArticle::create($validatedData);

        return redirect()->route('kbarticle.view', $article->id)
            ->with('success', 'Article created successfully.');
    }

    public function view($articleId)
    {
        $article = KBArticle::with('category', 'board')->findOrFail($articleId);
        $category = $article->category;
        $board = $article->board;

        return view('kbarticle.view', compact('article', 'category', 'board'));
    }

    public function showArticle($categoryId)
    {
        $category = KBCategory::with('children', 'articles')->findOrFail($categoryId);
        $board = $category->board;

        // Get all category IDs including children
        $allCategoryIds = $this->getAllCategoryIds($category);

        $articles = KBArticle::with('category')
            ->whereIn('category_id', $allCategoryIds)
            ->orderBy('list_order', 'asc')
            ->paginate(15);

        return view('kbarticle.kbarticles', compact('articles', 'category', 'board', 'allCategoryIds'));
    }


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
        foreach ($order as $item) {
            KBArticle::where('id', $item['id'])->update(['list_order' => $item['position']]);
        }
        return response()->json(['success' => true]);
    }
}
