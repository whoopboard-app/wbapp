<?php

namespace App\Http\Controllers;

use App\Models\KBArticle;
use Illuminate\Http\Request;
use App\Models\KBCategory;
use App\Models\KBBoard;

class KBCategoryController extends Controller
{
    public function create($board)
    {
        // Optionally, you can fetch the board if you need details
        $board = KBBoard::with('categories')->findOrFail($board);
        // dd($board);
        return view('kbarticle.partials.create_category', compact('board'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'board_id'     => 'required|exists:kb_boards,id',
            'categoryName' => 'required|string|max:255',
            'status'       => 'required|string',
            'short_desc'   => 'nullable|string|max:255',
            'category_img'     => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'parent_id'    => 'nullable|exists:kb_categories,id',
        ]);

        $category = new KBCategory();
        $category->tenant_id  = auth()->user()->tenant_id;
        $category->board_id   = $validatedData['board_id'];
        $category->parent_id  = $validatedData['parent_id'] ?? null;
        $category->name       = $validatedData['categoryName'];
        $category->short_desc = $validatedData['short_desc'];
        $category->status     = $validatedData['status'];
        $category->is_hidden  = $request->has('visibility') ? 1 : 0;
        $category->is_popular = $request->has('is_popular') ? 1 : 0;

        if ($request->hasFile('category_img')) {
            $category->image = $request->file('category_img')->store('categories', 'public');
        }

        $category->save();
        return redirect()->route('board.categories', ['board' => $request->board_id])
                 ->with('success', 'Category created successfully!');
    }

    public function articles($categoryId)
    {
        // Load the category with children recursively
        $category = KBCategory::with('children')->findOrFail($categoryId);
        $board = $category->board;

        // Recursive helper to get all child category IDs
        $allCategoryIds = $this->getAllCategoryIds($category);

        // Fetch articles that belong to this category or any child category
        $articles = KBArticle::with('category')
            ->whereIn('category_id', $allCategoryIds)
            ->orderBy('list_order', 'asc')
            ->paginate(15);
        return view('kbarticle.kbarticles', compact('articles', 'category', 'allCategoryIds', 'board'));
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
}
