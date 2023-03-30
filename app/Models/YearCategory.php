<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'year_name',
        'year_status',
    ];
}
