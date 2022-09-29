<?php

namespace App\Modules\Dispatcher;

use App\Modules\Dispatcher\Entities\Companies;
use App\Modules\Dispatcher\Entities\Tasks;

class Entities
{
    public static function userLeavesCompany($user, $company)
    {
        $tasks = new Tasks();
        $tasks->userLeavesCompany($user);

        $companies = new Companies();
        $companies->userLeavesCompany($user, $company);

        // TODO: подумать какие еще сущности проработать
    }
}
