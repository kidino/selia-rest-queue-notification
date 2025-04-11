<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        $token = $request->user()->plainToken()->first();

        return view('profile.edit', [
            'user' => $request->user(),
            'token' => $token,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    public function generateToken(Request $request)
    {
        $user = Auth::user();

        // Delete existing token and plain token if any
        $user->tokens()->where('name', 'profile-token')->delete();
        $user->plainToken()->delete();

        // Generate a new token
        $roles = $user->roles()->pluck('name')->toArray();
        $plainTextToken = $user->createToken('profile-token', $roles, now()->addYear())->plainTextToken;

        // Store the plain text token in the plain_tokens table
        $token = $user->tokens()->where('name', 'profile-token')->first();
        $user->plainToken()->create([
            'token_id' => $token->id,
            'token' => $plainTextToken,
        ]);

        return redirect()->back()->with('token', $plainTextToken);
    }


    public function deleteToken(Request $request)
    {
        $user = Auth::user();

        // Delete the profile token
        $user->tokens()->where('name', 'profile-token')->delete();
        $user->plainToken()->delete();

        return redirect()->back()->with('token', null);
    }


}
