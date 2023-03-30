<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Head extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'head_name',
        'head_status',
        'department_id'
    ];
}
