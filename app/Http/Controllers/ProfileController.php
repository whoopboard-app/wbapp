<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'user_type'  => 'required|in:1,2,3,4,5',
            'aboutme'    => 'nullable|string|max:1000',
            'short-desc'  => 'nullable|string|max:200',
            'profileImg' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        $user = auth()->user();
        // Image handling
        if ($request->hasFile('profileImg')) {
            // Delete old image if exists
            if ($user->profile_img && Storage::disk('public')->exists($user->profile_img)) {
                Storage::disk('public')->delete($user->profile_img);
            }

            // Store new image
            $profileImgPath = $request->file('profileImg')->store('profile_images', 'public');
        } else {
            // Preserve old image
            $profileImgPath = $user->profile_img;
        }

        $user->update([
            'name' => $validatedData['first_name'],
            'last_name'  => $validatedData['last_name'],
            'profile_img' => $profileImgPath,
        ]);

        return Redirect::route('dashboard')->with('success', 'User updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',       // must contain at least one uppercase letter
                'regex:/[0-9]/',       // must contain at least one number
                'regex:/[@$!%*#?&]/',  // must contain at least one special character
            ],
            'confirm_password' => ['required', 'same:new_password'],
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        
        return redirect()   
            ->route('dashboard')
            ->with('success', 'Password changed successfully!');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
