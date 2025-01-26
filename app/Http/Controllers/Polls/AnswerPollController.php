<?php

namespace App\Http\Controllers\Polls;

use App\Http\Controllers\Controller;
use App\Http\Requests\Polls\AnswerPollRequest;
use App\Models\Poll;
use Illuminate\Support\Facades\Auth;

use function redirect;

class AnswerPollController extends Controller
{
    public function __invoke(AnswerPollRequest $request, Poll $poll)
    {
        $answer = $request->boolean('answer');

        $userId = Auth::id();

        $userHasVoted = $poll->userAnswer;

        if (! $userHasVoted) {
            $poll->users()->sync([$userId => [
                'answer' => $answer,
            ]]);
        }

        return redirect()->route('polls');
    }
}
