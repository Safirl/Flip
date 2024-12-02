<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(): View
    {
        //Renvoie vers les polls du jour
        dd('hello world');
    }

    public function account(): View
    {
        dd('hello world');
    }

    public function feed(): View {
        //Return les feeds des actus de la semaine
        dd('hello world');
    }

    public function results(): View {
        dd('hello world');
        //Résultats d'un sondage
    }

    public function activity(): View {
        dd('hello world');
        //return toute l'activité liées aux commentaires
    }
}
