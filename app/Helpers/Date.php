<?php

namespace App\Helpers;

use Carbon\Carbon;

class Date
{
    public static function now()
    {
        return date('Y-m-d H:i:s', strtotime(Carbon::now()));
    }

    public static function humanDMY($timestamp)
    {
        return Date::getDay(date('d', strtotime($timestamp))).' '.Date::getMonth(date('m', strtotime($timestamp))).' '.date('Y', strtotime($timestamp));
    }

    public static function getMonth($number)
    {
        switch ($number) {
            case 1: return 'Января';
            case 2: return 'Февраля';
            case 3: return 'Марта';
            case 4: return 'Апреля';
            case 5: return 'Мая';
            case 6: return 'Июня';
            case 7: return 'Июля';
            case 8: return 'Августа';
            case 9: return 'Сентября';
            case 10: return 'Октября';
            case 11: return 'Ноября';
            case 12: return 'Декабря';
        }
    }

    public static function getDay($number)
    {
        switch ($number) {
            case 1: return 1;
            case 2: return 2;
            case 3: return 3;
            case 4: return 4;
            case 5: return 5;
            case 6: return 6;
            case 7: return 7;
            case 8: return 8;
            case 9: return 9;
            case 10: return 10;
            case 11: return 11;
            case 12: return 12;
            case 13: return 13;
            case 14: return 14;
            case 15: return 15;
            case 16: return 16;
            case 17: return 17;
            case 18: return 18;
            case 19: return 19;
            case 20: return 20;
            case 21: return 21;
            case 22: return 22;
            case 23: return 23;
            case 24: return 24;
            case 25: return 25;
            case 26: return 26;
            case 27: return 27;
            case 28: return 28;
            case 29: return 29;
            case 30: return 30;
            case 31: return 31;
        }
    }
}
