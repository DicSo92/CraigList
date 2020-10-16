<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $casts = [
        'images' => 'array',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
