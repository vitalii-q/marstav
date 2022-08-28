<?php

namespace App\Helpers;

class Regular
{
    public static function removeSymbols($str)
    {
        return preg_replace('/[^ a-zа-яё\d]/ui', '', $str );
    }
}
