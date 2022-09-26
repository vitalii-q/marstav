<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'stage_id', 'status', 'name', 'phone', 'email', 'position', 'company', 'product', 'price', 'deadline', 'note', 'code'
    ];
}
