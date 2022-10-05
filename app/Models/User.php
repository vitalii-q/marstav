<?php

namespace App\Models;

use App\Modules\Storage\Storage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'name', 'surname', 'patronymic', 'email', 'phone', 'position', 'photo', 'password', 'company_added', 'code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function employee($company_id, $code)
    {
        return User::query()->where('company_id', $company_id)->where('code', $code)->first();
    }

    public static function getWithRate()
    {
        $user = Auth::user();
        if(!$user) {
            return null;
        }

        $user = User::query()->select('users.*', 'companies.code as company_code', 'rates.name as rate_name', 'companies.paid', 'rates.users', 'rates.space')
            ->addSelect(['users_in_company' => User::query()->selectRaw('count(*)') // получаем количество пользователей в компании
                ->whereColumn('users.company_id', 'companies.id')
            ])->where('users.id', $user->id)
            ->leftJoin('companies', 'companies.id', '=', 'users.company_id')
            ->leftJoin('rates', 'rates.id', '=', 'companies.rate_id')
            ->first();

        if (!$user->company_id) { // стандартный тариф
            $primary = Rate::query()->where('name', 'Primary')->first();
            $user->rate_name = $primary->name;
            $user->users = $primary->users;
            $user->space = $primary->space;
        }

        return $user;
    }

    public static function getStorageInfo($user)
    {
        if ($user->company_id) {
            $space_involved = Storage::getSizeDir('storage/companies/'.$user->company_code);
        } else {
            $space_involved = Storage::getSizeDir('storage/users/'.$user->code);
        }

        if ($space_involved == 0) {
            $space_percents = 0;
        } else {
            $space_percent = $user->space / 100;
            $space_percents = $space_involved / $space_percent;
        }

        if ($space_percents > 90) {
            $style = 'danger';
        } else if ($space_percents > 65) {
            $style = 'warning';
        } else {
            $style = 'success';
        }

        return [$space_involved, $space_percents, $style];
    }
}
