<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKerjaCommission extends Model
{
    use HasFactory;

    public function commission()
    {
        return $this->belongsTo(Commission::class, 'commission_id');
    }
}
