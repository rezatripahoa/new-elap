<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    use HasFactory;

    protected $table = "program_kerja";

    public function year()
    {
        return $this->belongsTo(YearCategory::class, 'year_id');
    }

    public function category()
    {
        return $this->hasMany(ProgramKerjaCategory::class, 'program_kerja_id')->with('category');
    }

    public function pp()
    {
        return $this->hasMany(ProgramKerjaCommission::class, 'program_kerja_id');
    }

    public function pjp()
    {
        return $this->belongsTo(Department::class, 'departement_id');
    }

    public function type()
    {
        return $this->belongsTo(ProgramKerjaType::class, 'type_id');
    }
}
