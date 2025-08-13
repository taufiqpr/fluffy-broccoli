<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;



class LoginController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);

        $data = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        if (Auth::attempt($data)) {
            if (!Auth::user()->hasVerifiedEmail()) {
                Auth::logout();
                return redirect()->route('login')->with('failed', 'Akun belum diverifikasi. Silakan cek email.');
            }
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('failed', 'Email atau password salah');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('succes', 'kamu berhasil logout');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        $user->sendEmailVerificationNotification();

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan cek email untuk verifikasi sebelum login.');
    }


    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,

                ]);
            }

            Auth::login($user);

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('index')->with('error', 'Failed to authenticate using Google. Please try again.');
        }
    }
}
