<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddFriendRequest;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function addFriend(AddFriendRequest $request): RedirectResponse
    {
        $friend_id = User::where('friend_id', $request->validated())->first()->id;

        $isAlreadyAdded = Friend::where(function($query) use ($friend_id) {
            $query->where('user_id_1', Auth::user()->id)
                ->where('user_id_2', $friend_id);
        })->orWhere(function($query) use ($friend_id) {
            $query->where('user_id_2', Auth::user()->id)
                ->where('user_id_1', $friend_id);
        })->first();

        if ($isAlreadyAdded) {
            return redirect()->back()->withErrors(['friend_id' => 'Ami déjà ajouté']);
        }

        Friend::create([
            'user_id_1' => Auth::user()->id,
            'user_id_2' => $friend_id,
        ]);

        return redirect()->intended(route('account'))->with('success', 'Nouvel ami ajouté');
    }

    //Used to create a fake user. Don't use on prod
    private function createUser(string $password, string $email, string $name)
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'friend_id' => 12345678,
        ]);
    }
}
