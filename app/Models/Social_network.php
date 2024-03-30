<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Social_network extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'user_data_id',
        'email_id',
        'github_id',
        'linkedin_id'
    ];
}
