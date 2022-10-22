<?php

namespace App\Facades;

use App\Helpers\Date;
use App\Models\Notification;
use Carbon\Carbon;

class RateManager
{
    public static function switch($user, $company, $rate, int $months = 1)
    {
        $company->update([
            'rate_id' => $rate->id,
            'paid' => Carbon::now()->addMonths($months)
        ]);

        NotificationManager::confirm($user,
            'Подключен тарифный план: <strong class="notification_bigtext">'.$rate->name.'</strong>.<br> <small>Действует до: <br><strong>'.Date::humanDMY($company->paid).'.</strong></small>');
    }

    public static function renewal($user, $company, $rate, int $months = 1)
    {
        $company->update([
            'rate_id' => $rate->id,
            'paid' => Carbon::parse($company->paid)->addMonths($months)
        ]);

        NotificationManager::confirm($user,
            'Продлен тарифный план: <strong class="notification_bigtext">'.$rate->name.'</strong>.<br> <small>Действует до: <br><strong>'.Date::humanDMY($company->paid).'.</strong></small>');
    }
}
