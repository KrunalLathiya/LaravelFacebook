<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class FacebookController extends Controller
{
    /**
     * Redirect to Facebook for authentication.
     *
     * @return RedirectResponse
     */
    public function redirectToFacebook(): RedirectResponse
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle Facebook authentication callback.
     *
     * @return RedirectResponse
     */
    public function handleFacebookCallback(): RedirectResponse
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
        } catch (Throwable $e) {
            return redirect()->route('login')->with('error', 'Facebook authentication failed.');
        }
        // Retrieve user from the database by facebook_id or create a new user
        $user = User::firstOrCreate(
            ['facebook_id' => $facebookUser->id],
            [
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'password' => Hash::make(Str::random(16))
            ]
        );

        // Login the user
        Auth::login($user, true); // Remember the user

        return redirect()->intended('dashboard');
    }
}
