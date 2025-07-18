<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Auth;

class authenticateController extends Controller
{
    function renderLogin() {
        return view('auth.login',[
            'title'=>'Login',
        ]);
    }
    function renderRegister() {
        return view('auth.register',[
            'title'=>'Register',
        ]);
    }
    function renderforgotPassword() {
        return view('auth.forgot',[
            'title'=>'Forgot Password',
        ]);
    }

    function registerAksi(Request $request) {
        $user = new User();
        $validatedData = $request->validate([
            'name'=> 'required|string',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:8',
        ]);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password'];
        $user->role = UserRole::pembeli;
        $user->save();
        return redirect()->route('login');
    }
    function loginAksi(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->hasRole('pembeli')) {
                return redirect()->route('landing.home');
            }
            else {
                return redirect()->route('beranda');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    function logoutAksi(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    
}
