<?php

namespace App\Models;

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
        'unique_referral_code',
        'successful_referral',
        'is_admin'
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

    public function getId() {
        return $this->attributes['id'];
    }

    public function getName() {
        return $this->attributes['name'];
    }

    public function getUniqueReferralCode() {
        return $this->attributes['unique_referral_code'];
    }

    public function getSuccessfulReferral() {
        return $this->attributes['successful_referral'];
    }

    public function getIsAdmin() {
        return $this->attributes['is_admin'];
    }
}