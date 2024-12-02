<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppController extends Controller
{
    public function index(): View
    {
        //Renvoie vers les polls du jour

        return view('app.polls');
    }

    public function account(): View
    {
        return view('app.account');
    }

    public function feed(): View {
        //Return les feeds des actus de la semaine
        return view('app.feed');
    }

    public function results(): View {
        dd('hello world');
        //Résultats d'un sondage
    }

    public function notification(): View {
        return view('app.notification');
    }
}
