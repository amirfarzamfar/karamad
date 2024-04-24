<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, /*SoftDeletes,*/ HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    public function is_phone_verified()
    {
        return !is_null($this->phone_number_verified_at);
    }

    public function  phone_number_verified_at()
    {
        return $this->forceFill([
            'phone_number_verified_at' => $this->freshTimestamp()
        ])->save();
    }

    public function reset_pass_verified_at()
    {
        return $this->forceFill([
            'reset_pass_verified_at' => $this->freshTimestamp()
        ])->save();
    }

    public function is_reset_verified(): bool
    {
        return !is_null($this->reset_pass_verified_at);
    }

    public function undo_reset_pass_verified()
    {
        return $this->forceFill([
            'reset_pass_verified_at' => null
        ])->save();
    }


    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }


    public function organization()
    {
        return $this->hasMany(Organization::class);
    }

    //    public function personal_resumes()
    //    {
    //        return $this->hasMany(Personal_resume::class);
    //    }

    public function user_data()
    {
        return $this->hasOne(user_data::class);
    }

    public function jobCategory(): BelongsTo
    {
        return $this->belongsTo(Job_category::class);
    }
}
