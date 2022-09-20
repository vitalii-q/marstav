<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'from_id', 'to_id', 'text', 'view'];

    public static function attachFiles($messages)
    {
        $message_ids = [];
        foreach ($messages as $message) { array_push($message_ids, $message->id); }
        $files = File::query()->whereIn('message_id', $message_ids)->get();

        foreach ($messages as $message) {
            $message->time = date('n-j H:i', strtotime($message->created_at));

            $array = [];
            foreach ($files as $file) {
                if ($file->message_id == $message->id) {
                    array_push($array, $file);
                }
            }
            $message->files = $array;
        }

        return $messages;
    }
}
