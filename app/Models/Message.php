<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id', 'sender_role', 'message'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
