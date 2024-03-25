<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'gender',
        'marital_status',
        'year_of_birth',
        'military_exemption',
        'email',
        'phone_number',
        'province',
        'city',
        'address',
        'about_me',
        'jobCategory_id',
        'user_id'
    ];
}
