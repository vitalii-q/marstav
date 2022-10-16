<?php

namespace App\Facades;

use App\Models\Notification;

class NotificationManager
{
    public static function rate($user, $text)
    {
        Notification::query()->insert([
            'user_id' => $user->id,
            'type' => 'confirm',
            'title' => 'Уведмление',
            'text' => $text,
            'anchor' => $user->code,
            'code' => bin2hex(random_bytes(14))
        ]);
    }
}
