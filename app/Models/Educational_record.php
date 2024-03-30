<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Educational_record extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'user_data_id',
        'grade',
        'field_of_study',
        'university_name',
        'entering_year',
        'graduation_year',
        'currently_studying'
    ];
}
