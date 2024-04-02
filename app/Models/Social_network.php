<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Social_network extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'user_data_id',
        'instagram_id',
        'github_id',
        'linkedin_id'
    ];

    public function user_data(): BelongsTo
    {
        return $this->belongsTo(User_data::class);
    }
}
