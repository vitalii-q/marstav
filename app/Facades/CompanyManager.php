<?php

namespace App\Facades;

use App\Models\Dialog;
use App\Models\File;
use App\Models\Message;
use App\Models\User;

class CompanyManager
{
    public function checkEmployeesCompany($company)
    {
        $employees = User::query()->where('company_id', $company->id)->get();
        if(!count($employees)) {
            $company->delete();
        }
    }
}
