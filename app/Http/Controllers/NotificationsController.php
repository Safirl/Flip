<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Notifications\PollCommented;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use function redirect;
use function view;

class NotificationsController extends Controller
{
    public function index(): View
    {
        $commentsNotifications = Auth::user()
            ->unreadNotifications()
            ->where('type', PollCommented::class)
            ->get();

        return view('app.notifications', [
            'commentsNotifications' => $commentsNotifications,
        ]);
    }

    public function show(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        if ($notification->type === PollCommented::class) {
            $comment = Comment::find($notification->data['comment_id']);

            return redirect()->route('comments.show', [
                'poll' => $comment->poll,
                'comment-id' => $comment->id,
            ]);
        }
    }
}
