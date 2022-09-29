<?php

namespace App\Modules\Dispatcher\Entities;

use App\Models\Entities\Task;
use App\Models\Mediators\TaskUser;

class Tasks
{
    public function userLeavesCompany($user)
    {
        $mediators = TaskUser::query()->where('user_id', $user->id)->get();
        foreach ($mediators as $mediator) {
            if ($mediator->responsibility == 'observer') {
                $mediator->delete();
            } elseif ($mediator->responsibility == 'performer') {
                $task = Task::query()->find($mediator->task_id);
                if ($task->creator_id != $user->id) {
                    TaskUser::query()->where('task_id', $task->id)->where('user_id', $user->id)->delete();
                    TaskUser::query()->insert([
                        'task_id' => $task->id,
                        'user_id' => $task->creator_id,
                        'responsibility' => 'performer'
                    ]);
                }
            }
        }
    }
}
