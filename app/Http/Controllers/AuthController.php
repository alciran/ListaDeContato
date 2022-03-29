<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::check() === true){   
            $user = Auth::user();
            return view('home');            
        }

        return redirect()->route('login');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }else{
            $login_incorreto = "Login Incorreto!";
            return view('auth.login', compact('login_incorreto'));
        }
    
    }
}
