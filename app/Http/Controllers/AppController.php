<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Poll;
use App\Http\Requests\AddFriendRequest;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use function Sodium\add;


class AppController extends Controller
{


    public function index(Request $request): View
    {
//            Poll::create([
//                'quote' => "Les procurations pour les législatives ont quadruplé par rapport à 2022 » (juin 2024)",
//                'author' => "Emmanuel Macron",
//                'context' => "Lors de l’annonce de la dissolution de l’Assemblée nationale, Emmanuel Macron a avancé que le nombre de procurations avait quadruplé par rapport aux élections législatives précédentes.",
//                'analysis' => "En réalité, cette augmentation ne concerne qu’une période très spécifique et n’est pas représentative de l’ensemble des votes par procuration. L’information a été clarifiée par le ministère de l’Intérieur et critiquée pour son manque de nuance",
//                'title' => "Procuration législative",
//                'slug' => "procuration-legislative",
//                'published_at' => date('Y-m-d')
//            ]);
////
////            // Poll 2: "Should the government raise the minimum wage?"
//            Poll::create([
//                'quote' => "Paris est aujourd’hui l’une des villes les plus accessibles au monde pour les personnes en situation de handicap",
//                'author' => "Anne Hidalgo",
//                'context' => "Lors d’une conférence à l’Hôtel de Ville, la maire de Paris a salué les progrès de la ville en matière d’accessibilité. Ces propos sont appuyés par des rapports d’organisations internationales qui placent Paris parmi les leaders mondiaux pour l’accessibilité des espaces publics.",
//                'analysis' => "Une étude réalisée auprès de 3 500 personnes en situation de handicap révèle que dix grandes villes, dont Paris, ont été exclues du classement des destinations touristiques les plus accessibles. Parmi ces villes figurent également Amsterdam, Las Vegas et Londres. Cette situation met en lumière les récentes initiatives du gouvernement français, notamment le 'Plan 100% accessibilité', visant à faire de Paris une ville plus inclusive pour tous.
//Cependant, malgré ces efforts, des voix critiques, en particulier celles des associations de défense des droits des personnes handicapées, insistent sur la nécessité de poursuivre ces actions au-delà de 2024. Elles soulignent que de nombreuses lacunes demeurent, notamment dans l’accessibilité du métro et des bus. Ce constat est largement discuté dans les débats politiques actuels, où des partis comme La France Insoumise (LFI) appellent à une prise en compte renforcée de l’accessibilité dans les politiques publiques.",
//                'title' => "Paris accéssibilité",
//                'slug' => "paris-accessibilite",
//                'published_at' => date('Y-m-d')
//            ]);
//
//            // Poll 3: "Do you believe in the need for climate change policies?"
//            Poll::create([
//                'quote' => "La nouvelle loi immigration interdit désormais aux étrangers d’accéder aux prestations sociales.",
//                'author' => "Environmental Leader C",
//                'context' => "With increasing natural disasters and environmental destruction, the urgency to implement climate change policies has become a priority for governments worldwide.",
//                'analysis' => "While climate change policies are widely supported by environmentalists, some argue that the economic cost of implementing these policies could be too high.",
//                'title' => "Climate Change Policies",
//                'slug' => "climate-change-policies-3",
//                'published_at' => date('Y-m-d')
//            ]);
//
//            // Poll 4: "Is universal healthcare a fundamental right?"
//            Poll::create([
//                'quote' => "Healthcare should be accessible to all, regardless of income or status.",
//                'author' => "Health Advocate D",
//                'context' => "The debate about universal healthcare continues to spark polarized views. Some advocate for healthcare being a basic right, while others argue about its feasibility.",
//                'analysis' => "Supporters argue that universal healthcare ensures equity in access to services, while critics raise concerns about funding and potential inefficiency.",
//                'title' => "Universal Healthcare",
//                'slug' => "universal-healthcare-3",
//                'published_at' => date('Y-m-d')
//            ]);
//
//            // Poll 5: "Should governments prioritize spending on defense over education?"
//            Poll::create([
//                'quote' => "A strong defense ensures the safety and sovereignty of a nation, but investing in education will secure a prosperous future.",
//                'author' => "Politician E",
//                'context' => "This debate revolves around whether governments should allocate more funds to military defense or prioritize investments in education, which can shape a nation's long-term success.",
//                'analysis' => "The challenge is balancing immediate national security concerns with long-term investments in human capital.",
//                'title' => "Defense vs. Education Spending",
//                'slug' => "defense-vs-education-spending-3",
//                'published_at' => date('Y-m-d')
//            ]);


        // Récupère les sondages du jour
        $polls = Poll::where('published_at', date('Y-m-d'))->get();
        session(['previous_url' => url()->full()]);
        // Gère le vote si une réponse est soumise
        if ($request->isMethod('post')) {
            $pollId = $request->input('poll_id');
            $answer = filter_var($request->input('answer'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

            if ($pollId && $answer !== null) {
                $userId = Auth::id();

                // Vérifie si l'utilisateur a déjà voté
                $existingVote = DB::table('user_poll')
                    ->where('poll_id', $pollId)
                    ->where('user_id', $userId)
                    ->exists();

                if (!$existingVote) {
                    // Enregistre le vote
                    DB::table('user_poll')->insert([
                        'poll_id' => $pollId,
                        'user_id' => $userId ?? null,
                        'answer' => $answer,
                    ]);

                    session()->push('completed_polls', $pollId);
                }
            }
        }

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

        // Récupère si une réponse a été soumise pour une réutilisation dans la vue
        $answer = filter_var($request->input('answer'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        return view('app.polls', compact('polls'), ['isFeed' => false, 'answer' => $answer]);
    }

    public function isUserIdAnswer(Poll $poll, $userId): bool
    {

        $isUser = DB::table('user_poll')
            ->where('poll_id', $poll->id)
            ->where('user_id', $userId)
            ->exists();


        return $isUser;
    }

    public
    function account(): View
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

    public
    function feed(): View
    {
        //Return les feeds des actus de la semaine
        $polls = Poll::whereBetween('published_at', [
            date('Y-m-d', strtotime('-7 days')) . ' 00:00:00',
            date('Y-m-d') . ' 23:59:59'
        ])->get();
        session(['previous_url' => url()->full()]);
        return view('app.polls', compact('polls'), ['isFeed' => true]);
    }


    public
    function result(Request $request, Poll $poll): View|RedirectResponse
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


    public
    function notification(): View
    {
        return view('app.notification');
    }

    public
    function activity(): View
    {
        dd('hello world');
        //return toute l'activité liées aux commentaires
    }

    public
    function addFriend(AddFriendRequest $request): RedirectResponse
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

    //Used to create a fake user. Don't use on prod
    private
    function createUser(string $password, string $email, string $name)
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
//    return view('app.result', compact('poll'));
//        $polls = Poll::all();
//        if ($polls->slug != $slug) {
//            return to_route('app.result', ['slug' => $polls->slug]);
//        }
//        return view('app.polls', compact('polls'));
//
//    }

    public
    function showComments(Poll $poll): View
    {
        //We only want our friends comments and ours
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

    public
    function addComment(CommentRequest $request, Poll $poll): RedirectResponse
    {
        $data = $request->validated();
        $parent_id = $request->input('parent_id');
        if ($parent_id) {

            $parent_comment = Comment::find($parent_id);

            if (!$parent_comment) {
                return redirect()->route('comments.show', ['poll' => $poll])->with('success', 'L\'utilisateur n\'existe pas!');
            }

            if (!Auth::user()->friends()->contains(($parent_comment->user()->first())) && Auth::id() !== $parent_comment->user_id) {
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

}
