<?php

namespace App\Models;

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
        return User::query()->select('users.*', 'companies.code as company_code', 'rates.name as rate_name', 'companies.paid', 'rates.users', 'rates.space')->where('users.id', Auth::user()->id)
            ->leftJoin('companies', 'companies.id', '=', 'users.company_id')
            ->leftJoin('rates', 'rates.id', '=', 'companies.rate_id')
            ->first();
    }
}
