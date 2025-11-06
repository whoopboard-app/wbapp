<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionConfirmationMail;
use Illuminate\Support\Str;
use App\Models\Subscriber;

class SubscribeController extends Controller
{
    public function create()
    {
        // dd("create");
        return view('subscribe.signup'); 
    }

    public function signup(Request $request)
    {
       
       $request->validate([
            'full_name'  => 'required|string|max:255',
            'email' => 'required|email',
        ]);
        //  dd($request->all());
        try {
            $token = Str::random(40);
            $subscriber = Subscriber::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'token' => $token,
                'status' => 2,
                'subscribe_date' => now(),
            ]);
            Mail::to($request->email)
                ->send(new SubscriptionConfirmationMail($request->full_name, $token));
            return back()->with('success', 'Email sent! You will receive an email.');
        } catch (\Exception $e) {
            // Mail failed
            return back()
                ->withInput($request->only('full_name', 'email'))
                ->with('error', 'Something went wrong while sending the confirmation email. Please try again.');
        }
    }

    public function confirm($token)
    {
        $subscriber = Subscriber::where('token', $token)->first();
        if (!$subscriber) {
            // Token not found / invalid
            return redirect()->route('login')
                            ->with('error', 'Invalid or expired subscription link.');
        }
        
        $subscriber->update(['verified' => true, 'token' => null, 'status' => 1]);
        session()->flash('success', 'Your subscription has been confirmed!');
        return view('subscribe.confirmation_success');
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
       
        $validated['full_name'] = $validated['first_name'] . ' ' . $validated['last_name'];
        Subscriber::create($validated);
        return redirect()->route('subscribe.index')->with('success', 'Success! Subscribe created.');
    }
}
