<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invite';

    protected $fillable = [
        'email',
        'status',
        'user_id'
    ];

    private function user() {
        return $this->belongsTo(User::class, 'user_id', '');
    }

    public function getUser() {
        return $this->user();
    }
}
