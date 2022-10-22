<?php

namespace App\Facades;

use App\Models\Notification;

class NotificationManager
{
    public static function confirm($user, $text)
    {
        Notification::query()->insert([
            'user_id' => $user->id,
            'type' => 'confirm',
            'title' => 'Уведомление',
            'text' => $text,
            'anchor' => $user->code,
            'code' => bin2hex(random_bytes(14))
        ]);
    }

    public static function error($user, $text)
    {
        Notification::query()->insert([
            'user_id' => $user->id,
            'type' => 'error',
            'title' => 'Ошибка',
            'text' => $text,
            'anchor' => $user->code,
            'code' => bin2hex(random_bytes(14))
        ]);
    }
}
