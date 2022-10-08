<?php

namespace App\Models\Entities;

use App\Models\File;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['task_id', 'user_id', 'text'];

    public function avatar()
    {
        $user = User::query()->where('id', $this->user_id)->first();
        return $user->photo;
    }

    public function files()
    {
        return File::query()->where('comment_id', $this->id)->get();
    }
}
