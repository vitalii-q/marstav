<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'name', 'surname', 'patronymic', 'email', 'phone', 'position', 'photo', 'password', 'company_added', 'code'
    ];
}
