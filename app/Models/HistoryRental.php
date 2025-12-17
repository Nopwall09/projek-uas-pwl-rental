<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryRental extends Model
{
    protected $table = 'history_rental';
    protected $primaryKey = 'history_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['history_id', 'user_id', 'rental_id', 'aksi', 'waktu'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id'); 
    }

    public function rentalitem()
    {
        return $this->belongsTo(RentalItem::class, 'rental_id', 'rental_id'); 
    }
}
