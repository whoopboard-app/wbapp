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

        $boards = KBBoard::with('categories.articles')
            ->where('tenant_id', $tenantId)
            ->orderByDesc('id')
            ->get();

        $authors = User::where('tenant_id', $tenantId)->get();

        $categories = KBCategory::with('board')
            ->where('tenant_id', $tenantId)
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();
        $parentCategories = $categories;

        $tags = ChangelogTag::where('tenant_id', $tenantId)->pluck('tag_name', 'id');

        if ($parentCategories->isEmpty()) {
            $parentCategories = collect([(object)[
                'id' => null,
                'name' => 'No Categories Found',
                'board' => (object)['name' => 'N/A']
            ]]);
        }

        if ($tags->isEmpty()) {
            $tags = collect([null => 'No Data Found']);
        }

        return view('kbarticle.create', compact('parentCategories', 'categories', 'tags', 'boards', 'authors'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'                  => 'required|string|max:255',
            'description'            => 'required|string',
            'category_id'            => 'required|integer|exists:kb_categories,id',
            'show_widget'            => 'nullable|boolean',
            'link_changelog'         => 'nullable|array|min:1',
            'author'                 => 'required|array|min:1',
            'popular_article'        => 'nullable|boolean',
            'tagsSelect'             => 'required|array|min:1',
            'other_article_category' => 'nullable|integer|exists:kb_categories,id',
            'status'                 => 'required|string|in:active,inactive,draft',
            'article_banner'         => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'recName'            => 'nullable|string',
            'recDateTime'            => 'nullable|date',
        ]);

        // dd($validatedData);

        $validatedData['tenant_id'] = auth()->user()->tenant_id;
        $validatedData['tag_ids'] = implode(',', $request->tagsSelect);
        $validatedData['author'] = json_encode($validatedData['author']);
        if (isset($validatedData['link_changelog']) && is_array($validatedData['link_changelog'])) {
            $validatedData['link_changelog'] = implode(',', $validatedData['link_changelog']);
        }

        if ($request->hasFile('article_banner')) {
            $validatedData['article_banner'] = $request->file('article_banner')->store('article_banner', 'public');
        }

        $article = KBArticle::create($validatedData);

        return redirect()->route('kbarticle.view', $article->id)
            ->with('success', 'Article created successfully.');
    }

    public function view($articleId)
    {
        $article = KBArticle::with('category', 'board')->findOrFail($articleId);
        $category = $article->category;
        $board = $article->board;
        $tagIds = explode(',', $article->tag_ids);
        $tagNames = ChangelogTag::whereIn('id', $tagIds)->pluck('tag_name')->toArray();

        return view('kbarticle.view', compact('article', 'category', 'board','tagNames'));
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
        \Log::info('Sort payload:', $request->all());
        $order = $request->input('order', []);
        foreach ($order as $item) {
            KBArticle::where('id', $item['id'])->update(['list_order' => $item['position']]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Order changed successfully!'
        ]);
    }
    public function search(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $query = $request->get('q', '');
        $type = $request->get('type', 'all');

        $boards = KBArticle::where('tenant_id', $tenantId)
            ->when($query, function ($qBuilder) use ($query) {
                $qBuilder->where('title', 'like', "%{$query}%");
            })
            ->when($type === '1', function ($qBuilder) {
                $qBuilder->where('popular_article', 1);
            })
            ->when($type === '0', function ($qBuilder) {
                $qBuilder->where('popular_article', 0);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $html = view('kbarticle.partials.board_list', compact('boards'))->render();

        return response()->json(['html' => $html]);
    }
    public function edit($articleId)
    {
        $tenantId = auth()->user()->tenant_id;
        $categories = KBCategory::with('board')
            ->where('tenant_id', $tenantId)
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();
        $parentCategories = $categories;
        $authors = User::where('tenant_id', $tenantId)->get();
        $article = KBArticle::with('category', 'board')->where('tenant_id', $tenantId)->findOrFail($articleId);
        $boards = KBBoard::with('categories.articles')
            ->where('tenant_id', $tenantId)
            ->orderByDesc('id')
            ->get();
        $tags = ChangelogTag::where('tenant_id', $tenantId)->pluck('tag_name', 'id');
        return view('kbarticle.create', compact('article','boards', 'parentCategories', 'categories','tags','authors'));
    }
    public function update(Request $request, $articleId)
    {
     dd('update');
    }
    public function destroy($articleId)
    {
        dd('destroy');
    }
}
