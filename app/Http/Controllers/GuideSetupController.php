<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTheme;

class GuideSetupController extends Controller
{
    public function index()
    {
        $userTheme = UserTheme::where('user_id', auth()->id())->first();
        $labels = $userTheme && $userTheme->module_labels
            ? json_decode($userTheme->module_labels, true)
            : [];
        return view('guide_setup', compact('labels'));
    }
}
