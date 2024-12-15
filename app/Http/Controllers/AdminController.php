<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePollRequest;
use App\Models\Poll;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function createPoll(): View|RedirectResponse
    {
        $poll = new Poll();
        $poll->title = 'New Poll';
        return view('admin.createPoll', ['poll' => $poll]);
    }

    public function storePoll(CreatePollRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Poll::create([
            'title' => $data['title'],
            'context' => $data['context'],
            'analysis' => $data['analysis'],
            'published_at' => $data['published_at'],
            'quote' => $data['quote'],
            'slug' => $data['slug'],
            'is_intox' => $data['is_intox'],
            'author' => $data['author'],
        ]);

        return redirect()->route('polls')->with('success', 'Poll created successfully.');
    }

    public function editPoll(Poll $poll): View|RedirectResponse {

    }
    public function index() {
        $polls = Poll::orderBy('published_at', 'desc')->paginate(10);
        return view('admin.index', ['polls' => $polls]);
    }
}
