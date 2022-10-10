<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = User::getWithRate();
        list($space_involved, $space_percents, $storage_style) = User::getStorageInfo($user);

        return view('settings.settings', compact('user', 'space_involved', 'space_percents', 'storage_style'));
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
