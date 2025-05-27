<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $fillable = ['title', 'content', 'slug', 'status', 'published_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
