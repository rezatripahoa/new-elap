<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'category_id',
        'year_id',
        'document_name',
        'document_file',
    ];

    public function attachment()
    {
        return $this->hasMany(DocumentAttachment::class, 'document_id');
    }

    public function year()
    {
        return $this->hasOne(YearCategory::class, 'id', 'year_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
