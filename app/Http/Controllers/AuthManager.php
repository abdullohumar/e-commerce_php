<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
    function login()
    {
        return view('auth.login');
    }

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }
        return redirect()->intended('login')
            ->with('error', 'Invalid email or password');
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    function register() 
    {
        return view('auth.register');
    }

    function registerPost(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if($user->save()){
            return redirect()->intended(route('login'))->with([
                'success' => 'User created successfully'
            ]);
        }
        return redirect(route('register'))->with("error", "Something went wrong");
    }
}
