<?php

namespace App\Facades;

class UserManager
{
    public function replaceAvatar($user, $entity, $to = 'company')
    {
        if ($user->photo) {
            switch ($to) {
                case 'company': $path = FileManager::replace($user->photo, 'companies/' . $entity->code . '/'); break;
                case 'user':    $path = FileManager::replace($user->photo, 'users/' . $entity->code . '/'); break;
            }

            $user->update(["photo" => $path]);
        }
    }
}
