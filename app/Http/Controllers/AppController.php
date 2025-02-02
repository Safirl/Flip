<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddFriendRequest;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Friend;
use App\Models\Poll;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

use function session;

class AppController extends Controller
{
    public function index(): View
    {
        $polls = Poll::all()/*with('users')->where('published_at', date('Y-m-d'))->get()*/;

        session(['previous_url' => url()->full()]);

        return view('app.polls', compact('polls'), ['isFeed' => false]);
    }

    public function isUserIdAnswer(Poll $poll, $userId): bool
    {
        $isUser = DB::table('user_poll')
            ->where('poll_id', $poll->id)
            ->where('user_id', $userId)
            ->exists();

        return $isUser;
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

    public function feed(Request $request): View
    {
        // Récupère les sondages publiés durant la semaine
        $polls = Poll::whereBetween('published_at', [
            date('Y-m-d', strtotime('-7 days')).' 00:00:00',
            date('Y-m-d').' 23:59:59',
        ])->get();
        session(['previous_url' => url()->full()]);

        // Récupère la réponse soumise pour une réutilisation dans la vue
        $answer = filter_var($request->input('answer'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        // Ajoute les informations des votes pour chaque sondage
        foreach ($polls as $poll) {
            $poll->intoxCount = DB::table('user_poll')
                ->where('poll_id', $poll->id)
                ->where('answer', 0)
                ->count();

            $poll->infoCount = DB::table('user_poll')
                ->where('poll_id', $poll->id)
                ->where('answer', 1)
                ->count();
        }

        return view('app.polls', compact('polls'), ['isFeed' => true, 'answer' => $answer]);
    }

    public function result(
        Request $request,
        Poll $poll): View|RedirectResponse
    {
        $userId = Auth::id();
        if ($userId) {
            // Vérifie si l'utilisateur a déjà voté
            $existingVote = DB::table('user_poll')
                ->where('poll_id', $poll->id)
                ->where('user_id', $userId)
                ->first();

            if ($existingVote) {
                // Récupère les résultats
                $intoxCount = DB::table('user_poll')
                    ->where('poll_id', $poll->id)
                    ->where('answer', 0)
                    ->count();

                $infoCount = DB::table('user_poll')
                    ->where('poll_id', $poll->id)
                    ->where('answer', 1)
                    ->count();

                return view('app.result', [
                    'poll' => $poll,
                    'answer' => $existingVote->answer, // Utilise la réponse déjà enregistrée
                    'intoxCount' => $intoxCount,
                    'infoCount' => $infoCount,
                ]);
            }
        }

        // Nouvelle soumission de vote
        $answer = filter_var($request->input('answer'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if ($answer === null || $answer === '') {
            return redirect()->route('polls')->with('success', 'Veuillez voter avant de consulter les résultats.');
        }

        // Enregistre le vote
        DB::table('user_poll')->insert([
            'answer' => $answer,
            'user_id' => $userId ?? null,
            'poll_id' => $poll->id,
        ]);

        session()->push('completed_polls', $poll->id);

        // Récupère les résultats après le vote
        $intoxCount = DB::table('user_poll')
            ->where('poll_id', $poll->id)
            ->where('answer', 0)
            ->count();

        $infoCount = DB::table('user_poll')
            ->where('poll_id', $poll->id)
            ->where('answer', 1)
            ->count();

        return view('app.result', [
            'poll' => $poll,
            'answer' => $answer,
            'intoxCount' => $intoxCount,
            'infoCount' => $infoCount,
        ]);
    }

    public function notification(): View
    {
        return view('app.notification');
    }

    public function activity(): View
    {
        dd('hello world');
        // return toute l'activité liées aux commentaires
    }

    public function addFriend(
        AddFriendRequest $request): RedirectResponse
    {
        if ($request['friend_id'] === Auth::user()->friend_id) {
            return redirect()->back()->withErrors(['friend_id' => 'Vous essayez d\'ajouter votre ID!']);
        }
        $friend_id = User::where('friend_id', $request->validated())->first()->id;

        $isAlreadyAdded = Auth::user()->friends()->contains(function ($friend) use ($friend_id) {
            return $friend->id == $friend_id;
        });

        if ($isAlreadyAdded) {
            return redirect()->back()->withErrors(['friend_id' => 'Ami déjà ajouté']);
        }

        Friend::create([
            'user_id_1' => Auth::user()->id,
            'user_id_2' => $friend_id,
        ]);

        return redirect()->intended(route('account'))->with('success', 'Nouvel ami ajouté');
    }

    // Used to create a fake user. Don't use on prod

    public function showComments(
        Poll $poll): View
    {
        // We only want our friends comments and ours
        $friends = Auth::user()->friends();
        $comments = $poll->comments()->get();
        $friendsComments = $comments->filter(function ($comment) use ($friends) {
            return ($friends->contains('id', $comment->user_id) || $comment->user()->first()->id == Auth::id())
                && $comment->parent_id == null;
        });

        return view('app.comments', [
            'poll' => $poll,
            'friends_comments' => $friendsComments,
            'comments' => $comments,
        ]);
    }

    //	public function result( Poll $poll)
    //    {
    //    return view('app.result', compact('poll'));
    //        $polls = Poll::all();
    //        if ($polls->slug != $slug) {
    //            return to_route('app.result', ['slug' => $polls->slug]);
    //        }
    //        return view('app.polls', compact('polls'));
    //
    //    }

    public function addComment(
        CommentRequest $request,
        Poll $poll): RedirectResponse
    {
        $data = $request->validated();
        $parent_id = $request->input('parent_id');
        if ($parent_id) {
            $parent_comment = Comment::find($parent_id);

            if (! $parent_comment) {
                return redirect()->route('comments.show', ['poll' => $poll])->with('success', 'L\'utilisateur n\'existe pas!');
            }

            if (! Auth::user()->friends()->contains(($parent_comment->user()->first())) && Auth::id() !== $parent_comment->user_id) {
                return redirect()->route('comments.show', ['poll' => $poll])->with('success', 'Vous n\'êtes pas ami avec cet utilisateur !');
            }
        }

        Comment::create([
            'poll_id' => $poll->id,
            'parent_id' => $parent_id,
            'content' => $data['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('comments.show', ['poll' => $poll])->with('success', 'Commentaire publié !');
    }

    public function mentionslegales(): View
    {
        return view('app.mention');
    }

    private function createUser(
        string $password,
        string $email,
        string $name)
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'friend_id' => 12345678,
        ]);
    }
}
