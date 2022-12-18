<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Sluggable;

    CONST ACTIVE = 1;
    const INACTIVE = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'role_id',
        'status',
        'email_status',
        'email',
        'password',
        'slug',
        'created_by'
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
    ];

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => ['first_name','last_name']
            ]
        ];
    }
    public function getIsEmployeeAttribute()
    {
        return $this->role_id == Role::EMPLOYEE;
    }
    public function getIsAdminAttribute()
    {
        return $this->role_id == Role::ADMIN;
    }

    public function getIsEmailActiveAttribute()
    {
        return $this->email_status == true;
    }
    public function getIsActiveAttribute()
    {
        return $this->status == true;
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
