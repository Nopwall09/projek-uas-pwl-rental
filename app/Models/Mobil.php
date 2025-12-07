<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobil';
    protected $primaryKey = 'mobil_id';

    protected $fillable = [
        'merk_id',
        'status_id',
        'class_id',
        'tipe_id',
        'Transmisi',
        'mobil_warna',
        'mobil_plat',
        'mobil_tahun',
        'harga_rental',
    ];

    protected $casts = [
        'harga_rental' => 'decimal:2',
    ];

    public function merk()
    {
        return $this->belongsTo(Merk::class, 'merk_id', 'merk_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'status_id');
    }

    public function class()
    {
        return $this->belongsTo(CarClass::class, 'class_id', 'class_id');
    }

    public function tipe()
    {
        return $this->belongsTo(Tipe::class, 'tipe_id', 'tipe_id');
    }

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'memiliki_fasilitas', 'mobil_id', 'fasilitas_id');
    }

    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class, 'mobil_id', 'mobil_id');
    }
    public function seat()
    {
        return $this->belongsTo(Seat::class, 'seat_id', 'seat_id');
    }
}
