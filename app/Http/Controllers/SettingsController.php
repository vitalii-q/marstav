<?php

namespace App\Http\Controllers;

use App\Helpers\Converter;
use App\Helpers\Regular;
use App\Models\Company;
use App\Models\Rate;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = User::getWithRate();
        return view('settings', compact('user'));
    }

    public function rates()
    {
        $user = Auth::user();
        return view('settings.rates', compact('user'));
    }

    public function changeRates($rate_name)
    {
        $user = Auth::user();
        $rate = Rate::query()->where('name', strtolower($rate_name))->first();
        if (!$rate) {
            return view('oops');
        }

        if (!$user->company_id) {
            $company_id = Company::query()->insertGetId([
                'creator_id' => $user->id,
                'rate_id' => $rate->id,
                'paid' => Carbon::now()->addMonth(), // TODO: регулировать оплачеваемое время
                'name' => 'Company',
                'code' => 'company_'.bin2hex(random_bytes(16)),
            ]);

            $user->update([
                'company_id' => $company_id
            ]);
        } else {
            Company::query()->find($user->company_id)->update([
                'rate_id' => $rate->id,
                'paid' => Carbon::now()->addMonth()
            ]);
        }


        session()->flash('info', 'Поздравляем! Вы перешли на тарифный план: '.$rate->name);
        return redirect()->route('settings');
    }

    public function changeTheme(Request $request)
    {
        $user = Auth::user();
        Setting::query()->where('user_id', $user->id)->update([
            'theme' => $request->theme
        ]);
        return 1;
    }

    public function changeHeaderStyle()
    {
        $user = Auth::user();
        $settings = Setting::query()->where('user_id', $user->id) ->first();
        if ($settings->header_style == 'classic') {
            $settings->update(['header_style' => 'modern']);
        } else {
            $settings->update(['header_style' => 'classic']);
        }
        return 1;
    }

    public function changeHeaderMode()
    {
        $user = Auth::user();
        $settings = Setting::query()->where('user_id', $user->id) ->first();
        if ($settings->header_mode == 'fixed') {
            $settings->update(['header_mode' => 'static']);
        } else {
            $settings->update(['header_mode' => 'fixed']);
        }
        return 1;
    }

    public function changeSidebarStyle(Request $request)
    {
        $user = Auth::user();
        $settings = Setting::query()->where('user_id', $user->id) ->first();
        if ($request->style == 'dark') {
            $settings->update(['sidebar_style' => 'dark']);
        } else {
            $settings->update(['sidebar_style' => 'light']);
        }
        return 1;
    }
}
