<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller {

    public function login_google()
    {
        return view('logingoogle');
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->email)->first();

            if(!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    // Additional user details can be saved here
                ]);
            }

            Auth::login($user);

            return redirect()->route('home.landing');
        } catch (\Exception $e) {
            // Log the error message
            \Log::error($e->getMessage());

            // Redirect back with an error message
            return redirect()->route('index')->with('error', 'Failed to authenticate using Google. Please try again.');
        }
    }

    public function landing()
    {
        return view('landing');
    }
}
