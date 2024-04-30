<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Ticket\Chat;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
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
        'password_confirmation',
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




    public function is_phone_verified(): bool
    {
        return !is_null($this->phone_number_verified_at);
    }

    public function  phone_number_verified_at(): bool
    {
        return $this->forceFill([
            'phone_number_verified_at' => $this->freshTimestamp()
        ])->save();
    }

    public function reset_pass_verified_at(): bool
    {
        return $this->forceFill([
            'reset_pass_verified_at' => $this->freshTimestamp()
        ])->save();
    }

    public function is_reset_verified(): bool
    {
        return !is_null($this->reset_pass_verified_at);
    }

    public function undo_reset_pass_verified(): bool
    {
        return $this->forceFill([
            'reset_pass_verified_at' => null
        ])->save();
    }


    public function advertisements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Advertisement::class);
    }


    public function organization(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Organization::class);
    }

    //    public function personal_resumes()
    //    {
    //        return $this->hasMany(Personal_resume::class);
    //    }

    public function user_data(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(user_data::class);
    }

    public function jobCategory(): BelongsTo
    {
        return $this->belongsTo(Job_category::class);
    }


    public function ticketAdmin(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TicketAdmin::class);
    }

    public function chats(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Chat::class );
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Payment::class);
    }

}
