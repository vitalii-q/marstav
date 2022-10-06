<?php

namespace App\Facades;

use App\Models\Entities\Task;
use App\Models\Entities\TaskComment;
use App\Models\File;
use App\Models\Mediators\TaskUser;

class UserManager
{
    public function replaceAvatar($user, $entity, $to = 'company')
    {
        switch ($to) {
            case 'company': $path = FileManager::replace($user->photo, 'companies/' . $entity->code . '/avatars/'); break;
            case 'user':    $path = FileManager::replace($user->photo, 'users/' . $entity->code . '/avatars/'); break;
        }

        $user->update(["photo" => $path]);
    }
}
