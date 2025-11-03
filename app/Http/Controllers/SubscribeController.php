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
            ]);
            Mail::to($request->email)
                ->send(new SubscriptionConfirmationMail($request->full_name, $token));
            return back()->with('success', 'Email sent! You will receive a confirmation email.');
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
            return redirect()->route('subscribe.create')
                            ->with('error', 'Invalid or expired subscription link.');
        }
        
        $subscriber->update(['verified' => true, 'token' => null]);
        session()->flash('success', 'Your subscription has been confirmed!');
        return view('subscribe.confirmation_success');
    }
}
