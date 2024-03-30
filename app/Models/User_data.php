<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User_data extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = [
        'name',
        'family',
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
        'user_id'
    ];
}
