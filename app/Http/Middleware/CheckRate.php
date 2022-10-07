<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\Rate;
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
        //$space_involved = Storage::getSizeDir('storage/companies/'.$user->company_code); // TODO: если запускать проверку - cache

        if($user and $user->paid != null and $user->paid < Carbon::now() OR
            $user and $user->users != null and $user->users < $user->users_in_company)
        {
            return redirect()->route('rate_stub');
        }

        return $next($request);
    }
}
