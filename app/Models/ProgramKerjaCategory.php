<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKerjaCategory extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function program_kerja()
    {
        return $this->belongsTo(ProgramKerja::class, 'program_kerja_id')->with('type','pp','pjp');
    }
}
