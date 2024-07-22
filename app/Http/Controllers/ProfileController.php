<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        // $token = $user->tokens()->latest()->first()->token ?? 'No API token available';

        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        return redirect()->route('page.profile')->with('status', 'Profile updated successfully.');
    }
}
