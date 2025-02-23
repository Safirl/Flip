<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPollRequest;
use App\Models\Poll;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function createPoll(): View|RedirectResponse
    {
        Gate::authorize('do-admin-actions');

        $poll = new Poll;
        $poll->title = 'New Poll';

        return view('admin.createPoll', ['poll' => $poll]);
    }

    public function storePoll(FormPollRequest $request): RedirectResponse
    {
        Gate::authorize('do-admin-actions');

        Poll::create($this->extractData(new Poll, $request));

        return redirect()->route('polls')->with('success', 'Poll created successfully.');
    }

    public function updatePoll(Poll $poll, FormPollRequest $request): RedirectResponse
    {
        Gate::authorize('do-admin-actions');

        $poll->update($this->extractData($poll, $request));

        return redirect()->route('polls')->with('success', 'Poll updated successfully.');
    }

    public function editPoll(Poll $poll): View|RedirectResponse
    {
        Gate::authorize('do-admin-actions');

        return view('admin.createPoll', ['poll' => $poll]);
    }

    public function extractData(Poll $poll, FormPollRequest $request): array
    {
        Gate::authorize('do-admin-actions');

        $data = $request->validated();
        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        if (! $image && $image->getError()) {
            return $data;
        }
        if ($poll->image) {
            Storage::disk('public')->delete($poll->image);
        }
        $data['image'] = $image->store('polls', 'public');

        return $data;
    }

    public function index(): View
    {
        Gate::authorize('do-admin-actions');

        $polls = Poll::orderBy('published_at', 'desc')->paginate(5);

        return view('admin.index', ['polls' => $polls]);
    }
}
