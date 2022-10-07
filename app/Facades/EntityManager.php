<?php

namespace App\Facades;

class EntityManager
{
    public static function userLeavesCompany($user, $company)
    {
        $users = new UserManager();
        $users->replaceAvatar($user, $user, 'user'); // TODO: очередь

        $tasks = new TaskManager();
        $tasks->allocationUserTasks($user, $company); // TODO: очередь

        $messages = new MessageManager();
        $messages->deleteAllMessages($user); // TODO: очередь

        $companies = new CompanyManager();
        $companies->checkEmployeesCompany($company); // TODO: очередь
    }

    public static function companyAddUser($user, $company)
    {
        $users = new UserManager();
        $users->replaceAvatar($user, $company); // TODO: очередь

        $tasks = new TaskManager();
        $tasks->deleteUserTasks($user); // TODO: очередь
    }

    public static function userCreateCompany($user, $company)
    {
        $users = new UserManager();
        $users->replaceAvatar($user, $company); // TODO: очередь

        $tasks = new TaskManager();
        $tasks->relocationTaskFiles($user, $company); // TODO: очередь
    }
}
