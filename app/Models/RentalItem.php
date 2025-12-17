<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class RentalItem extends Model
{
    protected $table = 'rental_item';
    protected $primaryKey = 'rental_id';

    protected $fillable = [
        'user_id',
        'mobil_id',
        'driver_id',
        'nama_Pelanggan',
        'lama_rental',
        'pilihan',
        'tgl_sewa',
        'tgl_kembali',
        'total_sewa',
        'booking_source',
        'jaminan',
    ];

    protected $casts = [
        'tgl_sewa'    => 'date',
        'tgl_kembali' => 'date',
        'total_sewa'  => 'decimal:2',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function history()
    {
        return $this->hasMany(HistoryRental::class,'rental_id', 'rental_id');
    }
}
