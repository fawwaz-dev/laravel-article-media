<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('articles.{userId}', function ($user, $userId) {
    \Log::info('Otorisasi channel articles.' . $userId . ' untuk pengguna: ' . json_encode($user));
    return (int) $user->id === (int) $userId;
});
