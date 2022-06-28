<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invite';

    protected $fillable = [
        'email',
        'status',
        'user_id',
        'unique_referral_token'
    ];

    public function getUserId() {
        return $this->attributes['user_id'];
    }

    public function getUniqueReferralToken() {
        return $this->attributes['unique_referral_token'];
    }

    public function getEmail() {
        return $this->attributes['email'];
    }
}
