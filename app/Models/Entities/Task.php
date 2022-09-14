<?php

namespace App\Models\Entities;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'priority', 'status', 'deadline', 'code', 'deleted_at'];

    public static function get($user_id, $code)
    {
        return Task::query()->select('tasks.*')->join('task_user', 'task_user.task_id', '=', 'tasks.id')
            ->where('tasks.code', $code)
            ->where('task_user.user_id', $user_id)
            ->first();
    }

    public function comments()
    {
        return TaskComment::query()->where('task_id', $this->id)->get();
    }

    public function files()
    {
        return File::query()->where('task_id', $this->id)->get();
    }
}
