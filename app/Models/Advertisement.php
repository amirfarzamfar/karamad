<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Advertisement extends Model
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

    public function personal_resumes()
    {
        $this->hasMany(Personal_resume::class);
    }
    public function userDatas(): BelongsToMany
    {
        return $this->belongsToMany(User_data::class);
    }
}
