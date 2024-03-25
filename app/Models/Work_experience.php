<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_id',
        'job_title',
        'organization_name',
        'start_of_work',
        'end_of_work',
        'currently_employed'
    ];
}
