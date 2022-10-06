<?php

namespace App\Facades;

use App\Models\Entities\Task;
use App\Models\Entities\TaskComment;
use App\Models\File;
use App\Models\Mediators\TaskUser;
use App\Models\User;

class TaskManager
{
    public function relocationTaskFiles($user, $entity, $to = 'company')
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
            switch ($to) {
                case 'company': $path = FileManager::replace($user->photo, 'companies/' . $entity->code . '/avatars/'); break;
                case 'user':    $path = FileManager::replace($user->photo, 'users/' . $entity->code . '/avatars/'); break;
            }
            $file->update(["src" => $path]);
        }
    }

    public function deleteUserTasks($user)
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

    public function allocationUserTasks($user, $company)
    {
        // TODO: оптимизация
        $mediators = TaskUser::query()->where('user_id', $user->id)->get();
        foreach ($mediators as $mediator) {
            if ($mediator->responsibility == 'observer') {
                $mediator->delete();
            } elseif ($mediator->responsibility == 'performer') {
                $task = Task::query()->find($mediator->task_id);

                if ($task->creator_id == $user->id) {
                    $mediator->delete();
                    $this->transmitOrDelete($task);
                } else {
                    $mediator->delete();

                    $creator = User::query()->find($task->creator_id);
                    if($creator->company_id == $company->id) {
                        // передается создателю, можно сделать передачу на наблюдателя (сначала на наблюдателя если наблюдатель присутствует)
                        // потому что если создателя нет в наблюдателях, то у него не было доступа к задаче до перевода
                        // открывать доступ создателю нельзя так как получение задач завязанно на TaskUser
                        TaskUser::query()->where('task_id', $task->id)->where('user_id', $creator->id)
                            ->where('responsibility', '=', 'observer')->delete();

                        TaskUser::query()->insert([
                            'task_id' => $task->id,
                            'user_id' => $creator->id,
                            'responsibility' => 'performer'
                        ]);
                        $task->update(['status' => 'transmitted']);
                    } else {
                        $this->transmitOrDelete($task);
                    }
                }
            }
        }
    }

    private function transmitOrDelete($task)
    {
        $observers = TaskUser::query()->where('task_id', $task->id)->where('responsibility', '=', 'observer')->get();
        if(count($observers)) {
            $observers[0]->update([
                'responsibility' => 'performer'
            ]);
            $task->update([
                'status' => 'transmitted'
            ]);
        } else {
            $this->removeTethered($task);
            $task->delete();
        }

    }

    private function removeTethered($task)
    {
        $comments = TaskComment::query()->where('task_id', $task->id)->get();
        $comment_ids = [];
        foreach ($comments as $comment) {
            if (!in_array($comment->id, $comment_ids)) {
                array_push($comment_ids, $comment->id);
            }
        }

        $files = File::query()->whereIn('comment_id', $comment_ids)->get();
        foreach ($files as $file) {
            FileManager::delete($file->src);
        }

        File::query()->whereIn('comment_id', $comment_ids)->delete();
        TaskComment::query()->where('task_id', $task->id)->delete();
        TaskUser::query()->where('task_id', $task->id)->delete();
    }
}
