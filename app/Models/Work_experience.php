<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work_experience extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'user_data_id',
        'job_title',
        'organization_name',
        'start_of_work',
        'end_of_work',
        'currently_employed'
    ];

    public function user_data(): BelongsTo
    {
        return $this->belongsTo(User_data::class);
    }
}
