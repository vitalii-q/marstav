<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\User;
use App\Modules\Storage\Calculator;
use App\Modules\Storage\Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    public function rateStub()
    {
        $user = User::getWithRate();
        $primary = Rate::query()->where('name', 'Primary')->first();
        $users = User::query()->where('company_id', $user->company_id)->get();
        $space_involved = Storage::getSizeDir('storage/companies/'.$user->company_code);

        if(count($users) < $user->users and $space_involved < $user->space) {
            return redirect()->route('home');
        }

        // пользователи
        if (count($users) > $primary->users) {
            $users_bg = 'bg-danger';
            $users_percents = 100;
        } else {
            $primary_users_percent = $primary->users / 100;
            $users_percents = count($users) / $primary_users_percent;
            if ($users_percents > 65) {
                $users_bg = 'bg-warning';
            } else {
                $users_bg = 'bg-success';
            }
        }

        // пространство
        if($space_involved > $primary->space) {
            $space_bg = 'bg-danger';
            $space_percents = 100;
        } else {
            $primary_space_percent = $primary->space / 100;
            $space_percents = $space_involved / $primary_space_percent;
            if ($space_percents > 65) {
                $space_bg = 'bg-warning';
            } else {
                $space_bg = 'bg-success';
            }
        }

        return view('stubs.rate', compact('user', 'primary', 'users', 'users_percents', 'users_bg', 'space_involved', 'space_percents', 'space_bg'));
    }
}
