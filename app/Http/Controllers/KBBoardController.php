<?php

namespace App\Http\Controllers;

use App\Models\Changelog;
use App\Models\KBArticle;
use App\Models\KBCategory;
use Illuminate\Http\Request;
use App\Models\KBBoard;

class KBBoardController extends Controller
{
    protected $mainDomain;

    public function __construct()
    {
        $this->mainDomain = preg_replace('/^.*?([^.]+\.[^.]+)$/', '$1', request()->getHost());
        view()->share('mainDomain', $this->mainDomain);
    }
    public function index(Request $request)
    {
        $user = auth()->user();
        $tenant = $user->tenant;
        $tenantId = auth()->user()->tenant_id;
        $categories = KBCategory::where('tenant_id', $tenantId)->get();
        $articles = KBArticle::where('tenant_id', $tenantId)->paginate(10);
        $total = count(KBArticle::where('tenant_id', $tenantId)->get());
        $boards = KBBoard::where('tenant_id', $tenantId)->orderBy('created_at', 'desc')->paginate(10);
        $totalKB = count(KBBoard::where('tenant_id', $tenantId)->orderBy('created_at', 'desc')->get());
        $announcements = Changelog::where('tenant_id', $tenantId)
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        $filter = $request->get('filter', 'all');

        return view('kbarticle.index', compact('filter', 'announcements', 'categories', 'boards','tenant','total','totalKB','articles'));
    }
    public function create()
    {
        $mainDomain = $this->mainDomain;
        $tenant = auth()->user()->tenant;
        return view('kbarticle.create_board', compact('tenant','mainDomain'));
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
            'status' => 'integer|required',
        ]);
        $status = $request->has('draft') && $request->draft == 1 ? 2 : $request->status;
        $tenantID = auth()->user()->tenant_id;
        $board = KBBoard::create([
            'tenant_id'   => $tenantID,
            'name'        => $request->boardName,
            'description' => $request->boardDesc,
            'type'        => $request->boardType,
            'docs_type'   => $request->docsType,
            'is_hidden'   => $request->has('visibility') ? 1 : 0,
            'status'      => $status,
            'public_url'  => $request->bublicURL,
            'embed_code'  => $request->embedCode,
        ]);

        return redirect()->route('board.show', $board->id)
            ->with('success', 'Board created successfully!');
    }

    public function destroy($id)
    {
        $board = KBBoard::findOrFail($id);
        $board->delete();
        return redirect()->route('board.index')->with('success', 'Board Deleted successfully!');
    }
    public function show($boardId)
    {
        $board = KBBoard::with('categories.articles')->findOrFail($boardId);
        $kbcategories = $board->categories->sortBy('sort_order')->values();
        //dd($kbcategories);
        $total_kbcategories = $board->categories->count();
        // dd( $kbcategories);
        $totalCount = $board->categories->sum(function ($category) {
            return $category->articles->count();
        });
        return view('kbarticle.kbcategories', compact('board', 'totalCount', 'kbcategories', 'total_kbcategories'));
    }
    public function edit($id)
    {
        $mainDomain = $this->mainDomain;
        $tenant = auth()->user()->tenant;
        $board = KBBoard::findOrFail($id);

        return view('kbarticle.create_board', compact('tenant', 'board','mainDomain'));
    }
    public function update(Request $request, $boardId)
    {
        $board = KBBoard::findOrFail($boardId);
        $status = $request->has('draft') && $request->draft == 1 ? 2 : $request->status;
        $board->update([
            'name'         => $request->boardName,
            'description'  => $request->boardDesc,
            'type'         => $request->boardType,
            'docs_type'    => $request->docsType,
            'public_url'   => $request->bublicURL,
            'embed_code'   => $request->embedCode,
            'status'       => $status,
        ]);
        $board->is_hidden = $request->has('visibility') ? 1 : 0;
        $board->save();
        return redirect()->route('board.show', $board->id)
            ->with('success', 'Board Updated successfully!');
    }

    public function search(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $query = $request->get('q', '');
        $type = $request->get('type', 'all');

        $boards = KBBoard::where('tenant_id', $tenantId)
            ->when($query, function ($qBuilder) use ($query) {
                $qBuilder->where('name', 'like', "%{$query}%");
            })
            ->when($type === 'public', function ($qBuilder) {
                $qBuilder->where('type', 1);
            })
            ->when($type === 'private', function ($qBuilder) {
                $qBuilder->where('type', 0);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $html = view('kbarticle.partials.board_list', compact('boards'))->render();

        return response()->json(['html' => $html]);
    }


}
