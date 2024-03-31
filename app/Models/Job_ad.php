<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_ad extends Model
{
    use HasFactory;
     protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Job_category()
    {
        return $this->belongsTo(Job_category::class);
    }

}
