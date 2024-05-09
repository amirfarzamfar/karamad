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

class Advertisement extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $guarded = [];

    protected  $hidden = [
        "deleted_at",
        "updated_at",
    ];

    public function Organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function jobCategory(): BelongsTo
    {
        return $this->belongsTo(Job_category::class);
    }

    public function Skills(): hasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function userDatas(): belongsToMany
    {
        return $this->belongsToMany(User_data::class);
    }
    public function City(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function  Province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

}
