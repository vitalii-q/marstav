<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'surname', 'patronymic', 'email', 'private_email', 'phone', 'private_phone', 'position', 'company', 'address', 'born', 'note', 'code'
    ];
}
