<?php

namespace App\Facades;

class EntityManager
{
    public static function userLeavesCompany($user, $company)
    {
        $users = new UserManager();
        $users->replaceAvatar($user, $user); // TODO: очередь

        $tasks = new TaskManager();
        $tasks->userLeavesCompany($user, $company); // TODO: очередь

        $messages = new MessageManager();
        $messages->userLeavesCompany($user); // TODO: очередь

        $companies = new CompanyManager();
        $companies->userLeavesCompany($company); // TODO: очередь
    }

    public static function companyAddUser($user, $company)
    {
        $users = new UserManager();
        $users->replaceAvatar($user, $company, 'company'); // TODO: очередь
        $users->deleteTasks($user); // TODO: очередь
    }

    public static function userCreateCompany()
    {
        $users = new UserManager();
        //$users->userCreateCompany();
    }
}
