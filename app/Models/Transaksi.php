<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';

    protected $fillable = [
        'method_id',
        'rental_id',
        'tanggal_transaksi',
        'status',
        'total_bayar',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
    ];

    public function methodPembayaran()
    {
        return $this->belongsTo(MethodPembayaran::class, 'method_id', 'method_id');
    }

    public function rentalItem()
    {
        return $this->belongsTo(RentalItem::class, 'rental_id', 'rental_id');
    }
}