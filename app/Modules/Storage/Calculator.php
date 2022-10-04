<?php

namespace App\Modules\Storage;

class Calculator
{
    public static function bToGb($bytes)
    {
        $kb = (int)round($bytes / 1000);
        $mb = (int)round($kb / 1000);
        $gb = round($mb / 1000, 2);

        return $gb;
    }
}
