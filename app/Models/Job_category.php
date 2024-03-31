<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Job_ads(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Job_ad::class);
    }
}
