<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    //Return la view pour se connecter
    public function login(): View
    {
        return view('auth.login');
    }

    //Redirige vers la page se connecter
    public function register()
    {
        return view('auth.register');
    }

    public function createUser(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
        ]);
        Auth::login($user);

        $request->session()->regenerate();
        return redirect()->intended(route('polls'))->with('success', 'Account created and logged in successfully!');
    }

    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('polls'))->with('success', 'User connected successfully!');
        }
        return to_route('auth.login')->withErrors([
            'email' => 'Email ou mot de passe incorrect!',
        ])->onlyInput('email');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('success', 'You have been logged out!');
    }
}
