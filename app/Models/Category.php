<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_status',
    ];

    public function program_kerja_category()
    {
        return $this->hasMany(ProgramKerjaCategory::class, 'category_id');
    }
}
