<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionConfirmationMail;
use Illuminate\Support\Str;
use App\Models\Subscriber;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;


class SubscribeController extends Controller
{
    protected $tenant;

    public function __construct()
    {
        $this->tenant = $this->resolveTenantFromHost();
    }
    protected function resolveTenantFromHost()
    {
        $host = request()->getHost();
        $parts = explode('.', $host);

        if (count($parts) >= 3) {
            $subdomain = $parts[0];
        } else {
            $subdomain = null;
        }

        if ($subdomain) {
            $tenant = Tenant::where('custom_url', $subdomain)->first();
            if ($tenant) {
                return $tenant;
            }
        }
        return Tenant::where('page_publish', 1)->first();
    }
    public function create()
    {
        return view('subscribe.signup', [
            'tenant' => $this->tenant
        ]); 
    }

    public function signup(Request $request)
    {
       $request->validate([
            'full_name'  => 'required|string|max:255',
            'email' => 'required|email|unique:subscribers,email',
        ]);
        try {
            $token = Str::random(40);
            $host = $request->getHost();
            $parts = explode('.', $host);

            // If there’s no subdomain, fallback to 'demo' (or whatever default tenant)
            $subdomain = count($parts) >= 3 ? $parts[0] : 'demo';
            Mail::to($request->email)
                ->send(new SubscriptionConfirmationMail(
                    $request->full_name,
                    $token,
                    $subdomain
                ));
                
            $subscriber = Subscriber::create([
                'tenant_id' => $this->tenant->tenant_id ?? null,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'token' => $token,
                'status' => 2,
                'subscribe_date' => now(),
            ]);
           
            return back()->with('success', 'Email sent! You will receive an email.');
        } catch (\Exception $e) {
            // Mail failed
            return back()
                ->withInput($request->only('full_name', 'email'))
                ->with('error', 'Something went wrong while sending the confirmation email. Please try again.');
        }
    }

    public function confirm($subdomain, $token)
    {
        $subscriber = Subscriber::where('token', $token)->first();
        if (!$subscriber) {
            // Token not found / invalid
            return redirect()->route('login')
                            ->with('error', 'Invalid or expired subscription link.');
        }
        
        $subscriber->update(['verified' => true, 'status' => 1]);
        session()->flash('success', 'Your subscription has been confirmed!');
        return view('subscribe.confirmation_success', [
            'tenant' => $this->tenant
        ]);
    }

    public function index()
    {
        // dd("index");
        $subscribers = Subscriber::orderBy('created_at', 'desc')->get();
        return view('subscribe.index', [
            'subscribers' => $subscribers,
            'total_subs' => $subscribers->count(),
        ]);
    }

    public function store(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
      
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email'          => 'required|email|unique:subscribers,email',
            'linkedin_url' => 'nullable|url',
            'subscribe_date' => 'required|date',
            'short_desc' => 'nullable|string|max:300',
            'userSegments' => 'nullable|array',
            'addType' => 'nullable|string|max:255',
            'status' => 'required|int'
        ]);
        $validated['tenant_id'] = $tenantId;
        $validated['full_name'] = $validated['first_name'] . ' ' . $validated['last_name'];
        Subscriber::create($validated);
        return redirect()->route('subscribe.index')->with('success', 'Success! Subscribe created.');
    }
}
