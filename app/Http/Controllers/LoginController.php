<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function register_view()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = 3;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Registration successful. Please log in.');
    }

    public function admin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'type' => '1'])) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function user(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'type' => '3'])) {
            return redirect()->intended(route('user.dashboard'));
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
