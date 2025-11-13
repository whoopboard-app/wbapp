<?php

namespace App\Http\Controllers;

use App\Models\PlanTransaction;
use App\Models\SettingCategoryChangelog;
use App\Models\UserTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SegmentField;
use App\Models\TenantSegmentField;
use App\Models\Invite;

class AppSettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tenantId = $user->tenant_id;
        $planTransaction = PlanTransaction::with('membershipPlan')
            ->where('tenant_id', $tenantId)
            ->latest('transaction_date')
            ->first();
        $totalTeamMembers = Invite::where('invited_by_tenant', $tenantId)->count();
        return view('app-settings.index', compact('user', 'totalTeamMembers','planTransaction'));
    }
    public function segmentIndex(Request $request)
    {
        $defaultfields = SegmentField::all();
        $tenantId = auth()->user()->tenant_id;
        $search = $request->input('search');

        $tenantfields = TenantSegmentField::where('tenant_id', $tenantId)
            ->when($search, function ($query, $search) {
                $query->where('option_name', 'like', "%{$search}%")
                    ->orWhereHas('segmentField', function($q) use ($search) {
                        $q->where('field_name', 'like', "%{$search}%");
                    });
            })
            ->with('segmentField')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString(); // preserves ?search= in pagination links

        if ($request->ajax()) {
            return view('app-settings.partials.customizesegment', compact('tenantfields'))->render();
        }

        return view('app-settings.customizeSegment.view', compact('defaultfields','tenantfields'));
    }

    public function storeSegmentOption(Request $request)
    {
        $request->validate([
            'segment_field_id' => 'required|exists:segment_fields,id',
            'segment_option' => 'required|string|max:255',
            'status' => 'sometimes|boolean',
        ]);

        TenantSegmentField::create([
            'tenant_id' => auth()->user()->tenant_id,
            'segment_field_id' => $request->segment_field_id,
            'option_name' => $request->segment_option,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->back()->with('success', 'Segment option added successfully.');
    }
    public function checkName(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $segmentFieldId = $request->segment_field_id; // selected segment field
        $optionName = $request->option_name; // entered option

        $exists = TenantSegmentField::where('tenant_id', $tenantId)
            ->where('segment_field_id', $segmentFieldId)
            ->whereRaw('LOWER(option_name) = ?', [strtolower($optionName)])
            ->exists();

        return response()->json(['exists' => $exists]);
    }
    public function editSegment(TenantSegmentField $segmentOption)
    {
        $tenantId = auth()->user()->tenant_id;
        $defaultfields = SegmentField::all();
        $tenantfields = TenantSegmentField::where('tenant_id', $tenantId)
            ->with('segmentField')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('app-settings.customizeSegment.view', compact('segmentOption', 'defaultfields', 'tenantfields'));
    }

    public function updateSegmentOption(Request $request, $id)
    {
        $segmentOption = TenantSegmentField::findOrFail($id);

        $request->validate([
            'segment_field_id' => 'required|exists:segment_fields,id',
            'segment_option'   => 'required|string|max:255',
            'status'           => 'required|in:0,1,2',
        ]);

        $segmentOption->update([
            'segment_field_id' => $request->segment_field_id,
            'option_name'      => $request->segment_option,
            'status'           => $request->status,
        ]);

        return redirect()->route('segment.view')->with('success', 'Segment updated successfully.');
    }


}
