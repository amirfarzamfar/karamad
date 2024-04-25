<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement_user_data extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'advertisement_user_data';

    protected $guarded = [];
}
