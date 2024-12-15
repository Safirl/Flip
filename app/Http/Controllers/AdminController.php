<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPollRequest;
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

    public function storePoll(FormPollRequest $request): RedirectResponse
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

    public function updatePoll(Poll $poll, FormPollRequest $request): RedirectResponse
    {
        $poll->update($request->validated());
        return redirect()->route('polls')->with('success', 'Poll updated successfully.');
    }

    public function editPoll(Poll $poll): View|RedirectResponse {
        return view('admin.createPoll', ['poll' => $poll]);
    }
    public function index(): View {
        $polls = Poll::orderBy('published_at', 'desc')->paginate(10);
        return view('admin.index', ['polls' => $polls]);
    }
}
