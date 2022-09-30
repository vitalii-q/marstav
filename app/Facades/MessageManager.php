<?php

namespace App\Facades;

use App\Models\Dialog;
use App\Models\File;
use App\Models\Message;

class MessageManager
{
    public function userLeavesCompany($user)
    {
        $messages = Message::query()->where('from_id', $user->id)->orWhere('to_id', $user->id)->get();
        MessageManager::deleteMessageFiles($messages);
        Message::query()->where('from_id', $user->id)->orWhere('to_id', $user->id)->delete();
        Dialog::query()->where('user1_id', $user->id)->orWhere('user2_id', $user->id)->delete();
    }

    public static function deleteMessageFiles($messages)
    {
        $message_ids = [];
        foreach ($messages as $message) {
            if (!in_array($message->id, $message_ids)) {
                array_push($message_ids, $message->id);
            }
        }

        $files = File::query()->whereIn('message_id', $message_ids)->get();
        foreach ($files as $file) {
            FileManager::delete($file->src);
        }
        File::query()->whereIn('message_id', $message_ids)->delete();
    }
}
