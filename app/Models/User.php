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

    protected $fillable = [
        'name',
        'role',
        'username',
        'password',
        'email',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class, 'user_id', 'user_id');
    }

    // public function logAktivitas()
    // {
    //     // return $this->hasMany(LogAktivitas::class, 'user_id', 'user_id');
    // }

    public function historyRentals()
    {
        return $this->hasMany(HistoryRental::class, 'user_id', 'user_id');
    }
}
