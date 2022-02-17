<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'type',
        'status',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The users status
     *
     * @var array
     */
    public static $status = [
        'active', 
        'inactive', 
        'banned', 
        'suspended', 
        'blocked',
    ];

    /**
     * Any user may have many properties
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /**
     * A user may have a profile
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * A user may have many building materials listed
     */
    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    /**
     * A user may have many credits purchased
     */
    public function credits()
    {
        return $this->hasMany(Credit::class);
    }

    /**
     * A user may have many payments made
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * A user may have many promotions made
     */
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    /**
     * A user may have many service offerings
     */
    public function gigs()
    {
        return $this->hasMany(Gig::class);
    }
}
