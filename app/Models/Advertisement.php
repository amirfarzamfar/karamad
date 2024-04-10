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
    use HasFactory , SoftDeletes , InteractsWithMedia;

    protected $fillable = [
        'organization_id',
        'title',
        'gender',
        'type_of_cooperation',
        'military_exemption' ,
        'salary',
        'city/province',
        'degree_of_education',
        'address',
        'about',
        'status'
    ];

    public function Organization(): BelongsTo
    {
       return $this->belongsTo(Organization::class);
    }

    public function Categories(): belongsToMany
    {
        return $this->belongsToMany(Job_category::class);
    }

    public function Skills(): hasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function userDatas(): belongsToMany
    {
       return $this->belongsToMany(User_data::class);
    }
}
