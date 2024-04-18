<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Job_category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'job_category_name',
        'fa_job_category_name'
    ];

    protected $translatable = ['job_category_name'];

    public function advertisements(): HasMany
    {
        return $this->hasMany(Advertisement::class);
    }

    public function Organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }

    public function Users()
    {
        return $this->hasMany(User::class);
    }
}
