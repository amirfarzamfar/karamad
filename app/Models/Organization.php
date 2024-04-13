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

class Organization extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'organizations_name',
        'organizations_phone_number',
        'organizations_email',
        'organizations_web_address',
        'organizations_about',
        'city/province',
        'organizations_address',
        'number_of_staff'
    ];

    public function Categories(): belongsToMany
    {
        return $this->belongsToMany(Job_category::class);
    }

    public function User(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Advertisements(): hasMany
    {
        return $this->hasMany(Advertisement::class);
    }
}
