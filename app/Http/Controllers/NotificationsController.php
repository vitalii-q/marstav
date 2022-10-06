<?php

namespace App\Http\Controllers;

use App\Facades\EntityManager;
use App\Models\Company;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function companyInvitationSuccess(Request $request)
    {
        $user = Auth::user();
        $notification = Notification::query()->where('code', $request->code)->where('user_id', $user->id)->first();
        $company = Company::query()->where('code', $notification->anchor)->first();

        $user->update([
            'company_id' => $company->id,
            'company_added' => Carbon::now()
        ]);

        $notification->delete();

        EntityManager::companyAddUser($user, $company);

        return 1;
    }

    public function companyInvitationCancel(Request $request)
    {
        $user = Auth::user();
        $notification = Notification::query()->where('code', $request->code)->where('user_id', $user->id)->first();
        $notification->delete();

        return 1;
    }
}
