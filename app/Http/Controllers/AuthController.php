<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    //Return la view pour se créer un compte/ se connecter
    public function login(): View {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request) {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('polls'))->with('success', 'User connected successfully!');
        }
        return to_route('auth.login')->withErrors([
            'email' => 'Email ou mot de passe incorrect!',
        ])->onlyInput('email');
    }

    public function logout(): RedirectResponse {
        Auth::logout();
        return redirect('/');
    }

    //Permet de créer un compte dans la base de donnée
    public function register(LoginRequest $request) {
    }
}
