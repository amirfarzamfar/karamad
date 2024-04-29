<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Organization extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $guarded = [];

    protected $hidden = ['jobCategory'];

    public function jobCategory(): belongsTo
    {
        return $this->belongsTo(Job_category::class);
    }

    public function User(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Advertisements(): hasMany
    {
        return $this->hasMany(Advertisement::class);
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
