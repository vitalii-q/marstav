<?php

namespace App\Facades;

use App\Models\Entities\Task;
use App\Models\Entities\TaskComment;
use App\Models\File;
use App\Models\Mediators\TaskUser;

class UserManager
{
    public function replaceAvatar($user, $entity, $to = 'user')
    {
        switch ($to) {
            case 'company': $path = FileManager::replace($user->photo, 'companies/' . $entity->code . '/avatars/'); break;
            case 'user':    $path = FileManager::replace($user->photo, 'users/' . $entity->code . '/avatars/'); break;
        }

        $user->update(["photo" => $path]);
    }

    public function deleteTasks($user)
    {
        $tasks = Task::query()->select('tasks.*')->join('task_user', 'task_user.task_id', '=', 'tasks.id')
            ->where('task_user.user_id', $user->id)->get();
        $taskIds = [];
        foreach ($tasks as $task) { array_push($taskIds, $task->id); }

        $tasksComments = TaskComment::query()->whereIn('task_id', $taskIds)->get();
        $commentIds = [];
        foreach ($tasksComments as $comment) { array_push($commentIds, $comment->id); }

        $files = File::query()->whereIn('task_id', $taskIds)->orWhereIn('comment_id', $commentIds)->get();

        foreach ($files as $file) {
            FileManager::delete($file->src);
        }
        File::query()->whereIn('task_id', $taskIds)->orWhereIn('comment_id', $commentIds)->delete();
        TaskComment::query()->whereIn('task_id', $taskIds)->delete();
        TaskUser::query()->whereIn('task_id', $taskIds)->delete();
        Task::query()->whereIn('id', $taskIds)->delete();

        return 1;
    }

    public function userCreateCompany()
    {
        return 1;
    }
}
