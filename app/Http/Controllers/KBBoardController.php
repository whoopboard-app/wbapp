<?php

namespace App\Http\Controllers;

use App\Models\Changelog;
use App\Models\KBCategory;
use Illuminate\Http\Request;
use App\Models\KBBoard;

class KBBoardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $tenant = $user->tenant;
        $tenantId = auth()->user()->tenant_id;
        $categories = KBCategory::where('tenant_id', $tenantId)->get();
        $boards = KBBoard::where('tenant_id', $tenantId)->orderBy('created_at', 'desc')->get();
        $announcements = Changelog::where('tenant_id', $tenantId)
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        $filter = $request->get('filter', 'all');

        return view('kbarticle.index', compact('filter', 'announcements', 'categories', 'boards','tenant'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'boardName' => 'required|string|max:255',
            'boardDesc' => 'nullable|string',
            'boardType' => 'required|string',
            'docsType'  => 'required|string',
            'bublicURL' => 'nullable',
            'embedCode' => 'nullable|string',
        ]);
        $tenantID = auth()->user()->tenant_id;
        $board = KBBoard::create([
            'tenant_id'   => $tenantID,
            'name'        => $request->boardName,
            'description' => $request->boardDesc,
            'type'        => $request->boardType,
            'docs_type'   => $request->docsType,
            'is_hidden'   => $request->has('visibility') ? 1 : 0,
            'public_url'  => $request->bublicURL,
            'embed_code'  => $request->embedCode,
        ]);

        return redirect()->back()->with('success', 'Board created successfully!');
    }

    public function destroy($id)
    {
        $board = KBBoard::findOrFail($id);
        $board->delete();

        return redirect()->back()->with('success', 'Board deleted successfully!');
    }
    public function categories($boardId)
    {
        $board = KBBoard::with('categories.articles')->findOrFail($boardId);
        return view('kbarticle.kbcategories', compact('board'));
    }

    public function update(Request $request, $boardId)
    {
        $board = KBBoard::findOrFail($boardId);
        $board->update([
            'name'         => $request->boardName,
            'description'  => $request->boardDesc,
            'type'         => $request->boardType,
            'docs_type'    => $request->docsType,
            'public_url'   => $request->bublicURL,
            'embed_code'   => $request->embedCode,
        ]);

        $board->is_hidden = $request->has('visibility') ? 1 : 0;
        $board->save();

        return redirect()->back()->with('success', 'Board updated successfully!');
    }

    public function search(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $query = $request->get('q', '');

        $boards = KBBoard::with('categories.articles')
            ->where('tenant_id', $tenantId)
            ->when($query, fn($qBuilder) => $qBuilder->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%"))
            ->get();

        $html = view('kbarticle.partials.board_list', compact('boards'))->render();
        return response()->json(['html' => $html]);
    }
}
