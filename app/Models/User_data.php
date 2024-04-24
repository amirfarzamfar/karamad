<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User_data extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $guarded = [];

    public function user(): BelongsTo //
    {
        return $this->belongsTo(User::class);
    }

    public function educational_records(): HasMany //
    {
        return $this->hasMany(Educational_record::class);
    }

    public function personal_resumes(): HasMany
    {
        return $this->hasMany(Personal_resume::class);
    }

    public function skills(): HasMany //
    {
        return $this->hasMany(Skill::class);
    }

    public function social_networks(): HasMany //
    {
        return  $this->hasMany(Social_network::class);
    }

    public function work_experiences(): HasMany //
    {
        return $this->hasMany(Work_experience::class);
    }

    public function advertisements(): belongsToMany
    {
        return $this->belongsToMany(Advertisement::class);
    }
    public function Categories(): belongsTo
    {
        return $this->belongsTo(Job_category::class);
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function  province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
