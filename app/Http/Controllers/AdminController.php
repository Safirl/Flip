<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPollRequest;
use App\Models\Poll;
use GuzzleHttp\Psr7\UploadedFile;
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
        /** @var UploadedFile $image */;
        $image = $request->validated('image');
        $data['image'] = $image->store('polls', 'public');
        Poll::create([$data]);

        return redirect()->route('polls')->with('success', 'Poll created successfully.');
    }

    public function updatePoll(Poll $poll, FormPollRequest $request): RedirectResponse
    {
        $data = $request->validated();
        /** @var UploadedFile|null $image */;
        $image = $request->validated('image');
        if ($image && !$image->getError()) {
            $data['image'] = $image->store('polls', 'public');
        }
        $poll->update($data);
        return redirect()->route('polls')->with('success', 'Poll updated successfully.');
    }

    public function editPoll(Poll $poll): View|RedirectResponse {
        return view('admin.createPoll', ['poll' => $poll]);
    }
    public function index(): View {
        $polls = Poll::orderBy('published_at', 'desc')->paginate(5);
        return view('admin.index', ['polls' => $polls]);
    }
}
