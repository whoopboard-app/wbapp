<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GenericValue;
use App\Models\Segmentation;
use App\Models\Tenant;



class SegmentationController extends Controller
{
    public function create()
    {
        $tenant = Tenant::find(auth()->user()->tenant_id);

        $segmentFields = $tenant ? $tenant->tenantSegmentFields : collect();

        $gv_revenuerange = GenericValue::where('type', 'gv_revenuerange')->where('status', 1)->get();
        $gv_location = GenericValue::where('type', 'gv_location')->where('status', 1)->get();
        $gv_agerange = GenericValue::where('type', 'gv_agerange')->where('status', 1)->get();
        $gv_gender = GenericValue::where('type', 'gv_gender')->where('status', 1)->get();
        $gv_language = GenericValue::where('type', 'gv_language')->where('status', 1)->get();
        $gv_usetype = GenericValue::where('type', 'gv_usetype')->where('status', 1)->get();
        $gv_englevel = GenericValue::where('type', 'gv_englevel')->where('status', 1)->get();
        $gv_usagefre = GenericValue::where('type', 'gv_usagefre')->where('status', 1)->get();
        $gv_plan_type = GenericValue::where('type', 'gv_plan_type')->where('status', 1)->get();
        return view('segmentation.create', compact(
            'segmentFields',
            'gv_revenuerange',
            'gv_location',
            'gv_agerange',
            'gv_gender',
            'gv_language',
            'gv_usetype',
            'gv_englevel',
            'gv_usagefre',
            'gv_plan_type'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer',
            'short-desc' => 'nullable|string',
            'revenueRange' => 'nullable|integer',
            'location' => 'nullable|integer',
            'age' => 'nullable|integer',
            'gender' => 'nullable|integer',
            'language' => 'nullable|integer',
            'role' => 'nullable|integer',
            'plan_type' => 'nullable|array',
            'engagement' => 'nullable|integer',
            'frequency' => 'nullable|integer',
            'signup_date' => 'nullable|date',
        ]);

        $tenantId = auth()->user()->tenant_id;
        
        Segmentation::create([
            'tenant_id' => $tenantId,
            'name' => $request->name,
            'short_desc' => $request->{'short-desc'},
            'status' => $request->status,
            'revenue_range_id' => $request->revenueRange,
            'location_id' => $request->location,
            'age_id' => $request->age,
            'gender_id' => $request->gender,
            'language_id' => $request->language,
            'role_id' => $request->role,
            'plan_type' => isset($request->plan_type) ? implode(',', $request->plan_type) : null,
            'engagement_id' => $request->engagement,
            'frequency_id' => $request->frequency,
            'signup_date' => $request->signup_date,
        ]);

        return redirect()->route('subscribe.index')->with('success', 'Segmentation created successfully!');
    }
}
