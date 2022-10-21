<?php

namespace App\Http\Controllers;

use App\Facades\RateManager;
use App\Models\Company;
use App\Models\Notification;
use App\Models\Rate;
use App\Models\User;
use App\Modules\Storage\Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatesController extends Controller
{
    public function rates()
    {
        $user = User::getWithRate();
        $rates = Rate::query()->orderBy('price')->get();
        return view('settings.rates', compact('user', 'rates'));
    }

    public function changeRates(Request $request)
    {
        Notification::query()->insert([
            'user_id' => 1,
            'type' => 'confirm',
            'title' => 'Уведомление',
            'text' => 'test',
            'anchor' => 'qwerty',
            'code' => bin2hex(random_bytes(14))
        ]);

        //return $request;
        //
        // -------------------------

        // уведомлений sec key eyJ2ZXJzaW9uIjoiUDJQIiwiZGF0YSI6eyJwYXlpbl9tZXJjaGFudF9zaXRlX3VpZCI6Im02OW9jei0wMCIsInVzZXJfaWQiOiI3OTg1MDY1MjkwMyIsInNlY3JldCI6ImIxMTAzMTZiZTIyYzkyMjM2N2RhNjVkNmZjYTVjMzQxZTdlODFmYjM1YjM0YzdkNmZiYzAzOTFmOTc5OTY0MTMifX0=

        // bill / version
        //return $request->bill['status']['value'];



        // TODO: сначала оплата

        $user = User::query()->where('code', $request->bill['customer']['account'])->first();
        $rate = Rate::query()->where('price', $request->bill['amount']['value'])->first(); // TODO: улучшить получение
        if (!$rate) {
            return view('errors.oops');
        }

        if (!$user->company_id) {
            $company_id = Company::query()->insertGetId([
                'creator_id' => $user->id,
                'rate_id' => $rate->id,
                'paid' => Carbon::now()->addMonths(1), // TODO: регулировать оплачеваемое время
                'name' => 'Company',
                'code' => 'company_'.bin2hex(random_bytes(16)),
            ]);

            $user->update([
                'company_id' => $company_id
            ]);
        } else {
            $company = Company::query()->find($user->company_id);

            if($company->rate_id == $rate->id) {
                RateManager::renewal($user, $company, $rate);
            } else {
                RateManager::switch($user, $company, $rate);
            }
        }

        return 1;
    }

    public function addPayment()
    {}

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


