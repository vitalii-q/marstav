<?php

namespace App\Modules\Dispatcher\Entities;

use App\Models\Company;
use App\Models\User;

class Companies
{
    public function userLeavesCompany($user, $company)
    {
        $employees = User::query()->where('company_id', $user->company_id)->get();
        if(!count($employees)) {
            $this->removeTethered($company->id);
        }
    }

    public function removeTethered($company_id)
    {
        // TODO:
    }
}
