<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = 'mobil';
    protected $primaryKey = 'mobil_id';
    protected $fillable = [
        'merk_id', 'class_id', 'seat_id', 'nama_mobil', 
        'fasilitas', 'feedback', 'mobil_image', 'Transmisi', 
        'mobil_warna', 'mobil_plat', 'mobil_tahun', 
        'mobil_status', 'harga_rental'
    ];
    protected $casts = [
    'fasilitas' => 'array',
    ];

    // Foreign key relasi
    public function merk()
    {
        return $this->belongsTo(Merk::class, 'merk_id', 'merk_id');
    }

    public function carclass()
    {
        return $this->belongsTo(CarClass::class, 'class_id', 'class_id');
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class, 'seat_id', 'seat_id');
    }

    // Timestamps aktif karena ada created_at & updated_at
}
