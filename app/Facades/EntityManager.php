<?php

namespace App\Facades;

class EntityManager
{
    public static function userLeavesCompany($user, $company)
    {
        $tasks = new TaskManager();
        $tasks->userLeavesCompany($user, $company); // TODO: очередь

        $messages = new MessageManager();
        $messages->userLeavesCompany($user); // TODO: очередь

        $companies = new CompanyManager();
        $companies->userLeavesCompany($company); // TODO: очередь
    }
}
