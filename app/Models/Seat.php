<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $table = 'seat';
    protected $primaryKey = 'seat_id';
    public $timestamps = false;

    protected $fillable = [
        'seat_jumlah',
    ];

    public function mobil()
        {
            return $this->hasMany(Mobil::class, 'seat_id', 'seat_id');
        }
}

