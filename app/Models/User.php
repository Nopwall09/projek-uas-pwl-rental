<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'user_id';
    public $incrementing = true;       
    protected $keyType = 'int';        

    protected $fillable = [
        'name',
        'role',
        'username',
        'password',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isadmin()
    {
        return $this->role === 'admin';
    }
    public function isuser()
    {
        return $this->role === 'user';
    }
    public function iskasir()
    {
        return $this->role === 'kasir'; 
    }    
}
