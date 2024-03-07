<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

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
        'password' => 'hashed',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims() {
        return [];
    }    

    public function intern()
    {
        return $this->hasOne(Intern::class, 'users_id');
    }

    public function pm_daily_time_record()
    {
        return $this->hasMany(PmDailyTimeRecord::class, 'users_id');
    }

    public function am_daily_time_record()
    {
        return $this->hasMany(AmDailyTimeRecord::class, 'users_id');
    }

    public function break_time_record()
    {
        return $this->hasMany(BreakTimeRecord::class, 'users_id');
    }

    public function report()
    {
        return $this->hasMany(Report::class, 'users_id');
    }
}
