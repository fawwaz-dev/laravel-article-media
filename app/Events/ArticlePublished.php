<?php

namespace App\Events;

use App\Models\Article;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ArticlePublished implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $user_id;

    public function __construct(Article $article)
    {
        $this->title = $article->title;
        $this->user_id = $article->user_id;
        Log::info('Event ArticlePublished dibuat untuk artikel: ' . $article->id . ', user_id: ' . $article->user_id);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('articles.' . $this->user_id);
    }

    public function broadcastWith()
    {
        return [
            'title' => $this->title,
            'message' => 'Artikel baru telah dipublikasikan: ' . $this->title,
        ];
    }
}
