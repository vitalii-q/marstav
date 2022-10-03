<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Modules\Storage\Storage;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CheckRate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::getWithRate();
        if($user->paid != null and $user->paid < Carbon::now()) {
            $users = User::query()->where('company_id', $user->company_id)->get();
            $space_involved = Storage::getSizeDir('storage/companies/'.$user->company_code);

            if (count($users) > $user->users or $space_involved > $user->space) {

            }
        }

        dd($user->paid < Carbon::now());

        return $next($request);
    }
}
