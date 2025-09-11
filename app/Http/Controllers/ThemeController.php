<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\UserTheme;
use App\Models\Functionality;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::first();
        $user = auth()->user();
        $userTheme = UserTheme::where('user_id', $user->id)->first();
        // Get all functionalities
        $functionalities = Functionality::where('status', 1)->get();

        return view('themes.index', compact( 'themes','functionalities','userTheme'));
    }
    public function selectTheme(Request $request)
    {
        $request->validate([
            'theme_id' => 'required|exists:themes,id',
        ]);

        $userTheme = UserTheme::where('user_id', auth()->id())->firstOrFail();
        $userTheme->update(['theme_id' => $request->theme_id]);

        return back()->with('success', 'Theme updated successfully!');
    }

    public function customize(Request $request)
    {
        if(empty($request->brand_color)){
            $request->brand_color = '#f44336';
        }
        $moduleLabels = $request->filled('module_labels')
            ? array_map(fn($label) => ucfirst($label), $request->module_labels)
            : null;
        $request->validate([
            'brand_color'       => 'nullable|string|max:20',
            'theme_title'        => 'nullable|string|max:255',
            'welcome_message'   => 'nullable|string|max:500',
            'short_description' => 'nullable|string|max:500',
            'module_labels'     => 'nullable|array',
            'module_labels.*'   => 'nullable|string|max:255',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
            'meta_keywords'     => 'nullable|string|max:500',
            'google_analytics'  => 'nullable|string|max:1000',
            'is_visible'        => 'nullable|boolean',
            'is_password_protected' => 'nullable|boolean',
            'password'          => 'nullable|string|max:255',
        ]);
        $user = auth()->user();
        $userTheme = UserTheme::updateOrCreate(
            ['user_id' => $user->id],
            [
                'theme_id'         => '0',
                'brand_color'      => $request->brand_color,
                'theme_title'       => $request->theme_title,
                'welcome_message'  => $request->welcome_message,
                'short_description'=> $request->short_description,
                'module_labels'    => $moduleLabels ? json_encode($moduleLabels) : null,
                'meta_title'       => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords'    => $request->meta_keywords,
                'google_analytics' => $request->google_analytics,
                'is_visible'       => $request->boolean('is_visible'),
                'is_password_protected' => $request->boolean('is_password_protected'),
                'password'         => $request->is_password_protected ? $request->password : null,
            ]
        );

        return back()->with('success', 'Theme customized successfully!');
    }


    public function getModuleLabel($functionality)
    {
        $labels = $this->module_labels ? json_decode($this->module_labels, true) : [];
        $id = $functionality instanceof \App\Models\Functionality
            ? $functionality->id
            : $functionality;
        return $labels[$id] ?? ($functionality instanceof \App\Models\Functionality ? $functionality->name : null);
    }


}
