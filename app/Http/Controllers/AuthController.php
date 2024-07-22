<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('page.dashboard');
        }
        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) { 
            return redirect('/')->with('success', 'Login Berhasil!');
        } else {
            session()->flash('failed', 'Email atau password salah!');
            return redirect()->route('login');
        }
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('page.dashboard');
        }
        return view('auth.register');
    }

    public function prosesRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create API token
        // $token = $user->createToken('API Token')->plainTextToken;

        // Save the token in the personal_token table
        // PersonalToken::create([
        //     'tokenable_id' => $user->id,
        //     'tokenable' => User::class,
        //     'name' => 'API Token',
        //     'token' => $token,
        //     'abilities' => '["*"]', // Set the abilities as per your requirements
        // ]);

        Auth::login($user);

        // session()->put('token', $token);

        return redirect()->route('page.login')->with('success', 'Registration successful!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
