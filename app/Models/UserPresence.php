<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPresence extends Model
{
    protected $fillable = [
        'user_type',
        'user_id',
        'is_online',
        'last_seen',
    ];
}

