<?php

namespace App\Models;

use App\Helpers\Converter;
use App\Helpers\Regular;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealStage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'position', 'color'];

    public static function starterStages($user)
    {
        DealStage::query()->insert([
            [
                'user_id' => $user->id,
                'code' => str_replace(' ', '_', strtolower(Converter::transliteration(Regular::removeSymbols(mb_strimwidth(($user->surname?$user->surname:$user->name), 0, 40, "..")))))
                    .'_'.bin2hex(random_bytes(8)),
                'title' => 'Заявка',
                'color' => '#78C0FC',
                'position' => 1,
            ], [
                'user_id' => $user->id,
                'code' => str_replace(' ', '_', strtolower(Converter::transliteration(Regular::removeSymbols(mb_strimwidth(($user->surname?$user->surname:$user->name), 0, 40, "..")))))
                    .'_'.bin2hex(random_bytes(8)),
                'title' => 'Звонок',
                'color' => '#78C0FC',
                'position' => 2,
            ], [
                'user_id' => $user->id,
                'code' => str_replace(' ', '_', strtolower(Converter::transliteration(Regular::removeSymbols(mb_strimwidth(($user->surname?$user->surname:$user->name), 0, 40, "..")))))
                    .'_'.bin2hex(random_bytes(8)),
                'title' => 'Отправка',
                'color' => '#78C0FC',
                'position' => 3,
            ]
        ]);
    }
}
