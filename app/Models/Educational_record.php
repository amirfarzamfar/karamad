<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educational_record extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_id',
        'grade',
        'field_of_study',
        'university_name',
        'entering_name',
        'graduation_year'
    ];
}
