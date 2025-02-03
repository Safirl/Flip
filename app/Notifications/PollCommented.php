<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PollCommented extends Notification
{
    use Queueable;

    public function __construct(
        private readonly int $poll_id,
        private readonly int $comment_id,
        private readonly string $author,
        private readonly string $content,
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'poll_id' => $this->poll_id,
            'comment_id' => $this->comment_id,
            'author' => $this->author,
            'content' => $this->content,
        ];
    }
}
