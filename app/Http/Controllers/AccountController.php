<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use function view;

class AccountController extends Controller
{
    public function show(): View
    {
        $user = Auth::user();

        if (! $user) {
            return view('app.account');
        }

        $friends_list = Friend::where('user_id_1', $user->id)->orWhere('user_id_2', $user->id)->get();
        $friends = [];
        foreach ($friends_list as $friend_item) {
            if ($friend_item->user_id_1 === $user->id) {
                $friends[] = User::where('id', $friend_item->user_id_2)->first();
            } else {
                $friends[] = User::where('id', $friend_item->user_id_1)->first();
            }
        }

        return view('app.account', [
            'user' => $user,
            'friends' => $friends,
        ]);
    }
}
