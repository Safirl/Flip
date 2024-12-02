<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Return la view pour se créer un compte/ se connecter
    public function login(): View {
        dd('islogin');
    }

    public function authenticate(Request $request) {
    }

    public function logout(): RedirectResponse {
        Auth::logout();
        return redirect('/');
    }

    //Permet de créer un compte dans la base de donnée
    public function register(Request $request) {
    }
}
