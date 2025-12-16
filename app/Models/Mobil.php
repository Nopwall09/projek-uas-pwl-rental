<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = 'mobil';

    protected $primaryKey = 'mobil_id';
    public $timestamps = false;
    protected $casts = [
        'fasilitas' => 'array',
    ];

    protected $fillable = [
        'merk_id',
        'class_id',
        'seat_id',
        'nama_mobil',
        'fasilitas',
        'feedback',
        'mobil_image',
        'Transmisi',
        'mobil_warna',
        'mobil_status',
        'mobil_plat',
        'mobil_tahun',
        'harga_rental',
    ];



    public function merk()
    {
        return $this->belongsTo(Merk::class, 'merk_id');
    }

    public function carclass()
    {
        return $this->belongsTo(CarClass::class, 'class_id');
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class, 'seat_id');
    }
    
}
