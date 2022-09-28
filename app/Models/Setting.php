<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['theme', 'header_style', 'header_mode', 'sidebar_style'];

    public static function starterSettings($user_id)
    {
        Setting::query()->insert([
            'user_id' => $user_id,
            'theme' => 'default',
            'header_style' => 'classic',
            'header_mode' => 'fixed',
            'sidebar_style' => 'dark'
        ]);
    }
}
