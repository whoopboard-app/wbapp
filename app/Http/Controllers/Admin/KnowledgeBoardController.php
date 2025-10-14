<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KBBoard;

class KnowledgeBoardController extends Controller
{
    public function index()
    {
        $boards = KBBoard::with('tenant')->latest()->get();
        $boards->map(function ($board) {
            $board->client_name = null;

            if ($board->tenant && $board->tenant->users->isNotEmpty()) {
                $firstUser = $board->tenant->users->first();
                $board->client_name = $firstUser->name . ' ' . $firstUser->last_name;
            }

            return $board;
        });
        return view('admin.knowledge_board.index', compact('boards'));
    }
}
