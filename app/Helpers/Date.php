<?php

namespace App\Helpers;

use Carbon\Carbon;

class Date
{
    public static function now()
    {
        return date('Y-m-d H:i:s', strtotime(Carbon::now()));
    }
}
