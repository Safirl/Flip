<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class AppController extends Controller
{
    public function index(): View
    {
        //Dev only, create a new user
        //createUser('secret123', 'john@example.com', 'John');
        return view('app.polls');
    }

    public function account(): View
    {
        return view('app.account');
    }

    public function feed(): View
    {
        //Return les feeds des actus de la semaine
        return view('app.feed');
    }

    public function results(): View
    {
        dd('hello world');
        //Résultats d'un sondage
    }

    public function notification(): View
    {
        return view('app.notification');
    }

    public function activity(): View
    {
        dd('hello world');
        //return toute l'activité liées aux commentaires
    }

    private function createUser(string $password, string $email, string $name)
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }
}
