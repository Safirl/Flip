<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\Post;
use App\Http\Requests\AddFriendRequest;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use function Sodium\add;




class AppController extends Controller
{

    public function index(): View
    {
//        Poll::create(
//
//        );

        //Renvoie vers les polls du jour
        $polls = Poll::all();
        return view('app.polls', compact('polls'));
    }

    public function account(): View
    {
        if (Auth::check()) {
            $friends_list = Friend::where('user_id_1', Auth::id())->orWhere('user_id_2', Auth::id())->get();
            $friends = [];
            foreach ($friends_list as $friend_item) {
                if ($friend_item->user_id_1 == Auth::id()) {
                    $friends[] = User::where('id', $friend_item->user_id_2)->first();
                } else {
                    $friends[] = User::where('id', $friend_item->user_id_1)->first();
                }
            }
            return view('app.account', ['friends' => $friends]);
        }
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

        $isAlreadyAdded = Friend::where(function ($query) use ($friend_id) {
            $query->where('user_id_1', Auth::user()->id)
                ->where('user_id_2', $friend_id);
        })->orWhere(function ($query) use ($friend_id) {
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

//	public function result( Poll $poll)
//    {
        return view('app.result', compact('poll'));
//        $polls = Poll::all();
//        if ($polls->slug != $slug) {
//            return to_route('app.result', ['slug' => $polls->slug]);
//        }
//        return view('app.polls', compact('polls'));

//    }
}
