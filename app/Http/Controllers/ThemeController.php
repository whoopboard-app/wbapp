<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\UserTheme;
use App\Models\Functionality;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        $moduleLabels = [];
        if ($request->filled('module_labels') && is_array($request->module_labels)) {
            foreach ($request->module_labels as $key => $label) {
                $defaultLabel = $defaultTheme->module_labels[$key] ?? null;
                $moduleLabels[$key] = ($label !== $defaultLabel && $label !== null && $label !== '')
                    ? ucfirst($label)
                    : null;
            }
        } else {
            $moduleLabels = null;
        }
            $request->validate([
                'color_hex'       => 'nullable|string|max:20',
                'theme_title'        => 'nullable|string|max:255',
                'welcome_message'   => 'nullable|string|max:500',
                'short_description' => 'nullable|string|max:500',
                'module_labels'     => 'nullable|array',
                'module_labels.*'   => 'nullable|string|max:255',
                'meta_title'        => 'nullable|string|max:255',
                'meta_description'  => 'nullable|string|max:500',
                'meta_keywords'     => 'nullable|string|max:500',
                'google_analytics'  => 'nullable|string|max:1000',
                'is_visible' => 'nullable|in:on,off,1,0',
                'is_password_protected' => 'nullable|in:on,off,1,0',
                'password'          => 'nullable|string|max:255',
            ]);

        $featureBannerPath = null;
        if ($request->hasFile('feature_banner')) {
            $featureBannerPath = $request->file('feature_banner')->store('feature-banners', 'public');
        }
        else{
            $featureBannerPath = $request->existing_feature_banner;
        }
        $user = auth()->user();
        $userTheme = UserTheme::updateOrCreate(
            ['user_id' => $user->id],
            [
                'tenant_id'             => $user->tenant->tenant_id,
                'theme_id'              => 1,
                'brand_color'           => $request->color_hex,
                'theme_title'           => $request->theme_title,
                'welcome_message'       => $request->welcome_message,
                'short_description'     => $request->short_description,
                'module_labels'         => $moduleLabels ? json_encode($moduleLabels) : null,
                'meta_title'            => $request->meta_title,
                'meta_description'      => $request->meta_description,
                'meta_keywords'         => $request->meta_keywords,
                'google_analytics'      => $request->google_analytics,
                'is_visible'            => $request->is_visible === 'on' || $request->is_visible == 1,
                'is_password_protected' => $request->is_password_protected === 'on' || $request->is_password_protected == 1,
                'password'              => Hash::make($request->board_password),
                'theme_flag'            => $request->theme_flag,
                'feature_banner'        => $featureBannerPath,
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
    public function saveBaseConfig(Request $request)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'google_analytics' => 'nullable|string',
        ]);

        $user = auth()->user();

        UserTheme::updateOrCreate(
            [
                'tenant_id' => $user->tenant->tenant_id,
                'user_id'   => $user->id,
                'theme_id'  => '0',
            ],
            [
                'theme_flag' => '1',
                'meta_title'        => $request->meta_title,
                'meta_description'  => $request->meta_description,
                'meta_keywords'     => $request->meta_keywords,
                'google_analytics'  => $request->google_analytics,
            ]
        );

        return back()->with('success', 'Base configuration updated successfully!');
    }





}
