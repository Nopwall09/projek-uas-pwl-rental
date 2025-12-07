<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'driver';
    protected $primaryKey = 'driver_id';
    public $timestamps = false;

    protected $fillable = [
        'driver_nama',
        'driver_no_sim',
        'driver_no_telp',
    ];

    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class, 'driver_id', 'driver_id');
    }
}
