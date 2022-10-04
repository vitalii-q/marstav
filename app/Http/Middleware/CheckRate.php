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
        if($user->paid != null and $user->paid < Carbon::now()) {
            $rate = Rate::query()->where('name', 'Primary')->first();
            $users = User::query()->where('company_id', $user->company_id)->get();
            $space_involved = Storage::getSizeDir('storage/companies/'.$user->company_code);

            if ($user->rate_name != 'Primary') {
                Company::query()->find($user->company_id)->update(['rate_id' => $rate->id]);
            }

            if (count($users) > $rate->users or $space_involved > $rate->space) {
                return redirect()->route('rate_stub');
            }
        }

        return $next($request);
    }
}
