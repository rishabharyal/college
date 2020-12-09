<?php

namespace App\Models;

use App\Models\College;
use App\Models\Faculty;
use App\Models\UserCollege;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function membership() {
        return $this->hasOne(UserCollege::class);
    }

    public function college() {
        return $this->belongsToMany(College::class, 'user_colleges', 'user_id', 'college_id');
    }

    public function faculty() {
        return $this->belongsToMany(Faculty::class, 'user_colleges', 'user_id', 'faculty_id');
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }
}
