<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Rate;
use App\Models\User;
use App\Modules\Storage\Storage;
use Carbon\Carbon;

class ErrorsController extends Controller
{
    public function rateStub()
    {
        $user = User::getWithRate();
        if($user->paid != null and $user->paid < Carbon::now()) {
            $rate = Rate::query()->where('name', 'Primary')->first();
            $page_title = 'Подписка деактивирована';
            $page_text = 'Период вашей подписки завершен. Лимиты бесплатного тарифного плана Primary превышены. <br>
                        Вы можете продлить подписку для повышения лимитов в настройках.';

            if ($user->rate_name != 'Primary') {
                Company::query()->find($user->company_id)->update([
                    'rate_id' => $rate->id,
                    'paid' => null
                ]);
            }
        } else {
            $rate = Rate::query()->where('name', $user->rate_name)->first();
            $page_title = 'Превышены лимиты';
            $page_text = 'Лимиты вашей подписки превышены. <br> Вы можете подобрать подходящий тарифный план в настройках.';
        }

        if ($user->company_id) {
            $space_involved = Storage::getSizeDir('storage/companies/'.$user->company_code);
        } else {
            $space_involved = Storage::getSizeDir('storage/users/'.$user->code);
        }

        if($user->users_in_company <= $rate->users and $space_involved < $rate->space) {
            return redirect()->route('home');
        }

        // пользователи
        if ($user->users_in_company > $rate->users) {
            $users_style = 'danger';
            $users_percents = 100;
        } else {
            $primary_users_percent = $rate->users / 100;
            $users_percents = $user->users_in_company / $primary_users_percent;
            if ($users_percents > 90) {
                $users_style = 'danger';
            } else if ($users_percents > 65) {
                $users_style = 'warning';
            } else {
                $users_style = 'success';
            }
        }

        // пространство
        if($space_involved > $rate->space) {
            $storage_style = 'danger';
            $space_percents = 100;
        } else {
            $primary_space_percent = $rate->space / 100;
            $space_percents = $space_involved / $primary_space_percent;
            if ($space_percents > 90) {
                $storage_style = 'danger';
            } else if ($space_percents > 65) {
                $storage_style = 'warning';
            } else {
                $storage_style = 'success';
            }
        }

        return view('stubs.rate', compact('user', 'page_title', 'page_text', 'rate', 'users_percents', 'users_style', 'space_involved', 'space_percents', 'storage_style'));
    }
}
