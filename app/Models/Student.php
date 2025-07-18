<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'gender',
        'date_of_birth',
        'class_id',
        'photo',
        'address',
        'parent_name',
        'parent_phone',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
}
