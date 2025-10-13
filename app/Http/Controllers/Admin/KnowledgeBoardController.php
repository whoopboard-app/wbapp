<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KBBoard;

class KnowledgeBoardController extends Controller
{
    public function index()
    {
        $boards = KBBoard::latest()->get();
        dd($boards);
        return view('admin.knowledge_board.index', compact('boards'));
    }
}
