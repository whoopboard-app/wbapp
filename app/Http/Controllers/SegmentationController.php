<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SegmentationController extends Controller
{
    public function create()
    {
        return view('segmentation.create');
    }

    public function store(Request $request)
    {
        dd($request->all());

    }
}
