<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemilikiFasilitas extends Model
{
    use HasFactory;

    protected $table = 'memiliki_fasilitas';
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'fasilitas_id',
        'mobil_id',
    ];


    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'fasilitas_id', 'fasilitas_id');
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id', 'mobil_id');
    }
}
