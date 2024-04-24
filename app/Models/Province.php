<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    protected $hidden = [
      'status'
    ];

    public function Cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
    public function userDatas(): HasMany
    {
        return $this->hasMany(User_data::class);
    }
    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
    public function advertisements(): HasMany
    {
        return $this->hasMany(Advertisement::class);
    }
}
