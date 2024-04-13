<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job_category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'job_category_name'
    ];

    public function advertisements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Advertisement::class);
    }

    public function Organizations(): belongsToMany
    {
        return $this->belongsToMany(Organization::class);
    }
}
