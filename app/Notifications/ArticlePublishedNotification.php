<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ArticlePublishedNotification extends Notification
{
    use Queueable;

    protected $article;

    public function __construct($article)
    {
        $this->article = $article;
    }

    public function via($notifiable)
    {
        return ['database']; // Simpan ke tabel notifications
    }

    public function toDatabase($notifiable)
    {
        return [
            'article_id' => $this->article->id,
            'title' => $this->article->title,
            'message' => 'Artikel baru telah dipublikasikan: ' . $this->article->title,
            'user_id' => $this->article->user_id,
        ];
    }
}
