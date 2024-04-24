<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user_data(): BelongsTo
    {
        return $this->belongsTo(User_data::class);
    }

    public function advertisements(): belongsTo
    {
        return $this->belongsTo(Advertisement::class);
    }
}
