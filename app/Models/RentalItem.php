<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalItem extends Model
{
    use HasFactory;

    protected $table = 'rental_item';
    protected $primaryKey = 'rental_id';

    protected $fillable = [
        'user_id',
        'mobil_id',
        'driver_id',
        'lama_rental',
        'pilihan',
        'tgl',
        'total_sewa',
        'booking_source',
        'jaminan',
    ];

    protected $casts = [
        'tgl' => 'date',
        'total_sewa' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id', 'mobil_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'driver_id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'rental_id', 'rental_id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'rental_id', 'rental_id');
    }

    public function historyRentals()
    {
        return $this->hasMany(HistoryRental::class, 'rental_id', 'rental_id');
    }
}